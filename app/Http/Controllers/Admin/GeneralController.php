<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyTypes;
use App\Models\Report;
use App\Models\Role;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class GeneralController extends Controller
{
    public function dashboard(){

        // overall
        $users = User::all();
        $prop = Property::all();
        $report = Report::all();
        $age = Client::all();

        // Today
        $rep = Report::whereDate('created_at',Carbon::today())->get();
        $user = User::whereDate('created_at',Carbon::today())->get();
        $property = Property::whereDate('created_at',Carbon::today())->get();
        $agency = Client::whereDate('created_at',Carbon::today())->get();
        $views = Visitor::all();
        // dd($views);
        return view('admin.index', compact('rep', 'users', 'prop', 'report','age', 'user', 'property','agency', 'views'));
    }

    public function statusProp(Request $request, $id)
    {
        if($request->ajax()){
            $status = $request->status;

            $property = Property::findOrFail($id);
            if($property) {
                $property->status = $status;
                $property->save();
            }
            if($property->status == 1){
                return response()->json(['message' => 'Property has been activate. Property can be seen in the public!']);
            }
            else{
                return response()->json(['message' => 'Property has been inactive. Property cannot be seen in the public!']);
            }

        }


    }
    public function activeUser(Request $request, $id){
        if($request->ajax()){
            $active = $request->active;

            $user = User::findOrFail($id);

            if($user) {
                $user->active = $active;
                $user->save();
            }
            if($user->active == 1){
                return response()->json(['message' => 'User has been activated!']);
            }
            else{
                $prop = Property::where('user_id', $user->id)->get();
                // $image = array();
                foreach($prop as $property){
                    $images = PropertyImage::where('property_id', $property->id)->get();
                    $rep = Report::where('property_id', $property->id)->delete();
                    $property->propImages()->delete();
                    $property->propertyDetails()->delete();
                    $property->delete();
                    foreach($images as $image){
                        $path = 'property/'. $property->user_id. '/'. $property->id.'/'.$image->property_images; //path for the image
                        if(File::exists($path)){
                            unlink($path);
                        }
                    }
                }

                $fav = DB::table('favorite_prop')->where('user_id', $user->id)->delete();
                // $fav->delete();
                $user->testimonials()->delete();



                return response()->json(['message' => 'User has been deactivated!']);
            }

        }
    }
    public function searchUser(Request $request){

            $q = $request->get('search');
            $role = $request->get('role_type');
        if($q != null || $role != null){
            if($q){
                $users = DB::table('users')
                ->join('roles','roles.id', '=', 'users.role_id')
                ->select('users.id','users.fname','users.lname', 'users.mobile', 'users.province', 'users.city', 'users.barangay',
                'users.avatar','users.role_id','users.email', 'users.active', 'roles.role_type')
                ->orWhere('fname', 'like', "%{$q}%")
                ->orWhere('lname', 'like', "%{$q}%")
                ->orWhere('mobile', 'like', "%{$q}%")
                ->orWhere('province', 'like', "%{$q}%")
                ->orWhere('city', 'like', "%{$q}%")
                ->orWhere('barangay', 'like', "%{$q}%")
                ->orWhere('role_type', 'like', "%{$q}%")
                ->orderBy('id', 'asc')
                ->paginate(9);
            }
            if($role){
                $users = DB::table('users')
                ->join('roles','roles.id', '=', 'users.role_id')
                ->select('users.id','users.role_id','users.fname','users.lname', 'users.mobile', 'users.province', 'users.city', 'users.barangay',
                'users.avatar','users.email', 'users.active', 'roles.role_type')
                ->where('role_id', 'like', "%{$role}%")
                ->orderBy('id', 'asc')
                ->paginate(9);
            }
            if($q || $role){
                $users = DB::table('users')
                ->join('roles','roles.id', '=', 'users.role_id')
                ->select('users.id','users.role_id','users.fname','users.lname', 'users.mobile', 'users.province', 'users.city', 'users.barangay',
                'users.avatar','users.email', 'users.active', 'roles.role_type')
                ->where('role_id', 'like', "%{$role}%")
                ->where(function($query) use($q){
                    $query->orWhere('fname', 'like', "%{$q}%")
                        ->orWhere('lname', 'like', "%{$q}%")
                        ->orWhere('mobile', 'like', "%{$q}%")
                        ->orWhere('province', 'like', "%{$q}%")
                        ->orWhere('city', 'like', "%{$q}%")
                        ->orWhere('barangay', 'like', "%{$q}%")
                        ->orWhere('role_type', 'like', "%{$q}%");
                })->orderBy('id', 'asc')
                ->paginate(9);
            }
            $roles = Role::all();
            $reports = Report::all();
            return view('admin.usersIndex', compact('users', 'reports', 'role', 'roles'));
        }else{
            return redirect()->route('users.index');
        }


    }
    public function createPropType(Request $request){

        //return $request->all();

        $prop_type = new PropertyTypes;
        $prop_type->prop_type = $request->name;
        $prop_type->save();

        return redirect()->back()->with('success', 'Property Type has been saved!');
    }

    public function delFav($id){

        $user = Auth::user();
        $user->favorite_props()->detach($id);

        return redirect()->back()->with(['success', 'Favorite has been deleted']);
    }

    public function reports(){

        $rep = DB::table('reports')
        ->join('users','users.id','user_id')
        ->join('properties', 'properties.id', 'reports.property_id')
        ->join('property_details', 'property_details.property_id', 'reports.property_id')
        ->join('property_types', 'property_types.id', '=', 'properties.prop_type_id')
        ->select('properties.user_id','properties.status','users.fname', 'users.lname','properties.proj_name','reports.property_id','property_details.price',
        'properties.slug','property_types.prop_type', 'reports.subject', 'reports.client_id','reports.desc', 'reports.id', 'reports.created_at')
        ->orderBy('reports.created_at', 'DESC')->get();

        // dd($rep);
        $reports = array();
        for($i = 0; $i < count($rep); $i++){

            $report = Report::where('property_id', $rep[$i]->id)->first();
            if($report){
                array_push($reports, $report);
            }

        }
        //client
        $users = array();
        for($i = 0; $i < count($rep); $i++){

            $user = User::where('id', $rep[$i]->client_id)->first();
            if($user){
                array_push($users, $user);
            }


        }
        // dd($users);
        // dd($reports);
        $images = array();

        for($i = 0; $i < count($rep); $i++){
            $props = PropertyImage::where('property_id', $rep[$i]->id)->orderBy('sort', 'ASC')->first();
            array_push($images, $props);
        }

        return view('admin.reports', compact('rep', 'images', 'reports', 'users'));
    }
    public function delReport($id){

        $rep = Report::find($id);
        $rep->delete();

        return redirect()->back()->with(['success', 'Report has been deleted!']);
    }

    public function testimonial(){
        $test = Testimonial::all();
        $count = Testimonial::where('publish', 1)->count();

        return view('admin.testimonial',compact('test', 'count'));
    }
    public function publish(Request $request, $id){

        if($request->ajax()){
            $publish = $request->publish;

            $test = Testimonial::where('user_id', $id)->first();
            if($test) {
                $test->publish = $publish;
                $test->save();
            }
            if($test->publish == 1){
                return response()->json(['message' => 'Testimonial has been activated. Testimonial can be seen in the public!']);
            }
            else{
                return response()->json(['message' => 'Testimonial has been inactive. Testimonial cannot be seen in the public!']);
            }

        }
    }
}
