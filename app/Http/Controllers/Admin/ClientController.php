<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\PropertyImage;
use App\Models\Report;
use App\Models\User;
use Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(){
        //$users = User::all();
        // $agencies = Client::all();
        // $private = User::where('role_id', 2);
        // $public = Client::where('role_id', 3);
        $agencies =  DB::table('users')
                ->join('clients', 'clients.user_id','=', 'users.id')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->select('users.fname', 'users.lname', 'roles.role_type', 'clients.agency_name',
                'clients.agency_address', 'clients.office_no')->get();
        // dd($agencies);
        $private = User::where('role_id', 2)->count();
        $agent = User::where('role_id', 3)->count();

        return view('admin.agencies', compact('agencies', 'private', 'agent'));

    }
    public function private(){

        $agencies =  DB::table('users')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->select('users.fname', 'users.lname', 'users.email', 'users.mobile','roles.role_type')
        ->where('roles.role_type', 'Private')->get();

        return view('admin.private', compact('agencies'));
    }
    public function agent(){

        $agencies =  DB::table('users')
            ->join('clients', 'clients.user_id','=', 'users.id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select('users.fname', 'users.lname', 'users.email','roles.role_type', 'clients.agency_name',
            'clients.agency_address', 'clients.office_no')->where('roles.role_type', 'Agent')->get();

        return view('admin.agent', compact('agencies'));
    }

    public function reports(){


        $q = Request::input('uid');
        // dd($q);
        $rep = DB::table('reports')
            ->join('users','users.id','user_id')
            ->join('properties', 'properties.id', 'reports.property_id')
            ->join('property_details', 'property_details.property_id', 'reports.property_id')
            ->join('property_types', 'property_types.id', '=', 'properties.prop_type_id')
            ->select('properties.user_id','properties.status','users.fname', 'users.lname','properties.proj_name','reports.property_id','property_details.price',
            'properties.slug','property_types.prop_type', 'reports.subject', 'reports.client_id', 'reports.desc', 'reports.id', 'reports.created_at')
            ->orderBy('created_at', 'DESC')->where('properties.user_id', 'like', "%{$q}%")->get();



        // dd($rep);
        $reports = array();
        //$detail = PropertyDetails::where('property_id', $userProp->id)->get();
        for($i = 0; $i < count($rep); $i++){
            //get the first image of the property
            $report = Report::where('property_id', $rep[$i]->id)->first();
            if($report){
                array_push($reports, $report);
            }
        }
        $users = array();
        for($i = 0; $i < count($rep); $i++){

            $user = User::where('id', $rep[$i]->client_id)->first();
            if($user){
                array_push($users, $user);
            }

        }
        // dd($reports);
        $images = array();

        for($i = 0; $i < count($rep); $i++){
            $props = PropertyImage::where('property_id', $rep[$i]->id)->orderBy('sort', 'ASC')->first();
            array_push($images, $props);
        }

        return view('admin.reports', compact('rep', 'images', 'reports', 'users'));
    }

}

