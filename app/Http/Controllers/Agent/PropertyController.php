<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Property;
use App\Models\PropertyDetails;
use App\Models\PropertyImage;
use App\Models\PropertyTypes;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all property of the user
        $userProp = Property::where('user_id', Auth::user()->id)->get();

        //create an array to store all images of the property of the user
        $images = array();
        //$detail = PropertyDetails::where('property_id', $userProp->id)->get();
        for($i = 0; $i < count($userProp); $i++){
            //get the first image of the property
            $props = PropertyImage::where('property_id', $userProp[$i]->id)->orderBy('sort', 'ASC')->first();
            array_push($images, $props);
        }
        //get all details


        $user =  Auth::user()->id;
        $properties = DB::table('properties')
        ->where('user_id', $user)
        ->join('property_details','property_details.property_id', '=', 'properties.id')
        ->join('property_types', 'property_types.id', '=', 'properties.prop_type_id')
        ->select( 'properties.id','properties.proj_name', 'properties.slug', 'properties.publish','properties.created_at',
        'property_details.price', 'property_details.prop_location', 'property_types.prop_type')
        ->orderBy('created_at', 'DESC')->paginate(9);

        $reports = array();

        for($i = 0; $i < count($properties); $i++){
            //get the first image of the property
            $report = Report::where('property_id', $properties[$i]->id)->first();
            if($report){
                array_push($reports, $report);
            }
        }
        // dd($reports);

            return view('agent.property',compact('properties', 'images', 'reports'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property)
    {
        $agency = Client::where('user_id', Auth::user()->id)->value('office_no');
        $prop_type = PropertyTypes::all();
        return view('agent.createProperty',compact('agency', 'prop_type'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //return $request->all();

        $request->validate([
            'proj_name' => 'required',
            'price' => 'required|integer',
            'property_type' => 'required',
            'desc' => 'required',
        ]);
        // dd($request->all());
        $images = $request->file('files');
        $len = count($images);
        if($len <= 10){
            DB::transaction(function () use($request){

                //get the user id
                $user_id = Auth::user()->id;



                //property
                $property = new Property;
                $property->user_id = $user_id;
                $property->prop_type_id = $request->property_type;
                $property->proj_name = $request->proj_name;
                $property->slug = SlugService::createSlug(Property::class, 'slug', $request->proj_name);
                $property->stat_view = 0;
                $property->save();

                //get the property id
                $property_id = $property->id;

                //Property Details
                $propDetails = new PropertyDetails;
                $propDetails->property_id = $property_id;
                $propDetails->price = $request->price;
                $propDetails->prop_location = $request->prop_location;
                $propDetails->desc = $request->desc;
                $propDetails->save();


                if($request->hasFile('files')){

                    $images = $request->file('files');
                    $len = count($images);

                    $path = 'property/'.$user_id. '/'. $property_id; //path for the image
                    for($i = 0; $i < count($images); $i++){
                        $name = pathinfo($images[$i], PATHINFO_FILENAME);
                        $filename = $name.'.jpeg';     //filename of the image in database
                        // dd($filename);
                        //$url = $images[$i]->move(public_path($path), $filename);  //move image name to public path
                        $images[$i]->move(public_path($path), $filename);  //move image name to public path
                        //array_push($fileslink, $url);
                        //save to database
                        $file = new PropertyImage();
                        $file->property_id = $property_id;
                        $file->sort = $i;
                        $file->property_images = $filename;
                        $file->save();


                    }

                }



            });
            return redirect()->route('properties.index');

        }else{
            return redirect()->back()->with('error', 'Number of files selected for upload exceeds maximum allowed limit of 10');
        }



    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->id;
        $property = Property::find($id);
        $images = $property->propImages()->pluck('property_images');
        $path = 'property/'.$user. '/'. $property->id; //path for the image
        $url = public_path($path, $images);
        return response()->json([
            'images'=>$images,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $agency = Client::where('user_id', Auth::user()->id)->value('office_no');
        $prop_type = PropertyTypes::all();
        $detail = PropertyDetails::where('property_id', $property->id)->first();
        // dd($detail);
        $images = PropertyImage::where('property_id', $property->id)->orderBy('sort', 'ASC')->get();
        //dd($images);
        //$path = 'property/'.Auth::user()->id. '/'. $property->id;
        // dd($property);
        return view('agent.editProperty',compact('property', 'agency',
        'detail', 'prop_type', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user_id = Auth::user()->id;

        $request->validate([
            'proj_name' => 'required',
            'price' => 'required',
            'property_type' => 'required',
            'desc' => 'required',
        ]);

        //property

        $property = Property::find($id);
        $property->user_id = $user_id;
        $property->prop_type_id = $request->property_type;
        $property->proj_name = $request->proj_name;
        $property->slug = SlugService::createSlug(Property::class, 'slug', $request->proj_name);
        $property->stat_view = 0;
        $property->save();

        //get the property id
        $property_id = $property->id;

        //Property Details
        $propDetails = PropertyDetails::where('property_id', $property_id)->first();
        $propDetails->property_id = $property_id;
        $propDetails->price = $request->price;
        $propDetails->prop_location = $request->prop_location;
        $propDetails->desc = $request->desc;
        $propDetails->save();



        return redirect()->route('properties.index')->with('success', 'Property has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prop = Property::where('id', $id)->first();
        // dd($prop);
        $image = PropertyImage::where('property_id', $prop->id)->get();
        $fav = DB::table('favorite_prop')->where('property_id', $id)->delete();

        foreach($image as $property){
            $path = 'property/'.$prop->user_id. '/'. $prop->id.'/'.$property->property_images; //path for the image
            if(File::exists($path)){
                unlink($path);
            }
            //$property->delete();
        }

        $prop->propImages()->delete();
        $prop->propertyDetails()->delete();

        $prop->delete();

        return redirect()->route('properties.index')->with('success', 'Successfully deleted the property!');


    }

}
