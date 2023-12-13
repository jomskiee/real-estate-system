<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facilities;
use Illuminate\Support\Facades\File;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyDetails;
use App\Models\PropertyImage;
use Request;
use Illuminate\Support\Facades\DB;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $q = Request::input('uid');
        // dd($q);
        if($q != null){

            $properties = DB::table('properties')
            ->join('users','users.id', '=', 'properties.user_id')
            ->join('property_types', 'property_types.id', '=', 'properties.prop_type_id')
            ->join('property_details','property_details.property_id', '=', 'properties.id')
            ->select('users.fname', 'users.lname', 'properties.id','properties.proj_name','properties.user_id', 'properties.slug','properties.created_at',
            'property_details.price','property_types.prop_type','property_details.prop_location')
            ->orderBy('created_at', 'DESC')->where('properties.user_id', 'like', "%{$q}%")->get();
            //dd($data);
            //$properties = Property::paginate(6);
            //create an array to store all images of the property of the user
            $images = array();

            for($i = 0; $i < count($properties); $i++){
                $props = PropertyImage::where('property_id', $properties[$i]->id)->orderBy('sort', 'ASC')->first();
                array_push($images, $props);
            }
        }else{

            $properties = DB::table('properties')
            ->join('users','users.id', '=', 'properties.user_id')
            ->join('property_types', 'property_types.id', '=', 'properties.prop_type_id')
            ->join('property_details','property_details.property_id', '=', 'properties.id')
            ->select('users.fname', 'users.lname', 'properties.id','properties.proj_name','properties.user_id', 'properties.slug','properties.created_at',
            'property_details.price','property_types.prop_type','property_details.prop_location')
            ->get();
            //dd($data);
            //$properties = Property::paginate(6);
            //create an array to store all images of the property of the user
            $images = array();

            for($i = 0; $i < count($properties); $i++){
                $props = PropertyImage::where('property_id', $properties[$i]->id)->orderBy('sort', 'ASC')->first();
                array_push($images, $props);
            }
        }


        return view('admin.property', compact('properties', 'images'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $property = Property::find($id);
    //     $propImage = PropertyImage::where('property_id', $property->id)->get();
    //     $propDetails = PropertyDetails::where('property_id', $property->id)->first();

    //     $facilities = DB::table('facility_property')->where('property_id', $property->id)->get();
    //     return view('admin.viewProp', compact('property', 'propImage', 'propDetails','location', 'facilities'));
    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


}
