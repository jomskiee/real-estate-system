<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Client;
use App\Models\Property;
use App\Models\Report;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){

        $users = DB::table('users')
                ->join('roles','roles.id', '=', 'users.role_id')
                ->select('users.id','users.role_id','users.fname','users.lname', 'users.mobile', 'users.province', 'users.city', 'users.barangay',
                'users.avatar','users.active','users.email','roles.role_type')->orderBy('users.id', 'ASC')->paginate(9);

        //get the client of the properties
        $properties = Property::all();

        // for($i = 0; $i < count($users); $i++){
        //     $prop = Property::where('user_id', $users->id)->first();
        //     dd($prop);
        //     if($prop){
        //         array_push($properties, $prop);
        //     }
        // }
        // dd($prop);
        // $reports = Report::all();
        // dd($properties);
        $reports = array();
        for($i = 0; $i < count($properties); $i++){

            $rep = Report::where('property_id', $properties[$i]->id)->first();
            if($rep){
                array_push($reports, $rep);
            }

        }
        $roles = Role::all();
        // dd($reports);
        // dd($users);

        return view('admin.usersIndex', compact('users', 'reports', 'roles'));
    }

    public function show($id){

        $user = DB::table('users')
        ->join('roles','roles.id', '=', 'users.role_id')
        ->where('users.id', $id)
        ->select('users.id','users.fname','users.lname', 'users.mobile', 'users.province', 'users.city', 'users.barangay',
        'users.avatar','users.email','roles.role_type')->first();
        $agency = Client::where('user_id', $user->id)->first();
        // dd($agent);
        $prop = Property::where('user_id', $user->id)->count();
        $fav = DB::table('favorite_prop')->where('user_id', $user->id)->count();


        return view('admin.profile', compact('user','agency' ,'prop', 'fav'));
    }

    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser != $user || $currentUser->role !== 'admin') {
            $user->delete();

            return redirect()->route('users.index')->with('success', 'Successfully deleted the user!');
        }
        return back()->with('error', 'You cannot delete yourself!');
    }
}
