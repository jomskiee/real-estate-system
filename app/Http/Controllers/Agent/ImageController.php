<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Facilities;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyDetails;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function sort(Request $request){

        $images = array();
        if(isset($_POST['data'])){
            $images = $_POST['data'];
        }

        if(count($images) > 0){
            // Update sort position of images
            $position = 1;
            foreach($images as $image){
                DB::table('property_images')->where('id', $image)->update(['sort'=> $position]);
                $position ++;
            }
            echo 1;
            exit;
        }else{

            echo 0;
            exit;
        }

    }
    public function uploadImage(Request $request, $id){
        //$property = Property::find($id);
        if($request->ajax()){
            $property = Property::find($id);

            //dd($images);
            $urls = [];
            $maxFiles = PropertyImage::where('property_id', $property->id)->get();
            $maxFileCount = count($maxFiles);
            if($maxFileCount == 10){
                return response()->json(['message' => 'Number of files selected for upload exceeds maximum allowed limit of 10.']);
            }else{
                if($request->hasFile('files')){
                    $images = $request->file('files');
                    $len = count($images);
                    //$fileslink = array(); //get all url images
                    $path = 'property/'.Auth::user()->id. '/'. $property->id; //path for the image
                    for($i = 0; $i < $len; $i++){
                        $name = pathinfo($images[$i], PATHINFO_FILENAME);
                        $filename = $name.'.jpeg';  //filename of the image in database
                        $images[$i]->move(public_path($path), $filename);  //move image name to public path
                        $url = 'property/'.Auth::user()->id. '/'. $property->id.'/'.$filename;
                        //dd($url);

                        array_push($urls, $url);
                        //save to database
                        $file = new PropertyImage();
                        $file->property_id = $property->id;
                        $file->property_images = $filename;
                        $file->sort = $i;
                        $file->save();
                    }

                }
                return $urls;
            }
        }

    }
    public function publishProp(Request $request, $id){
        if($request->ajax()){
            $publish = $request->publish;

            $property = Property::findOrFail($id);
            if($property) {
                $property->publish = $publish;
                $property->save();
            }
            if($property->publish == 1){
                return response()->json([
                    'success' => 'Property has been publish. Property can be seen in the public!',
                    'data' => 'Publish Property'
                ]);
            }
            else{
                return response()->json([
                    'success' => 'Property is not publish. Property cannot be seen in the public!',
                    'data' => 'Unpublish Property'

                ]);
            }


        }

    }
    public function deleteImage(Request $request)
    {
        //return $request->all();
        //dd($request->all());
        $image = PropertyImage::find($request->key);
        $path = 'property/'.Auth::user()->id. '/'. $image->property_id.'/'.$image->property_images;
        if(File::exists($path)){
            unlink($path);
        }
        $image->delete();
        return true;


    }
    public function searchProp(Request $request){

            $q = $request->get('query');

            $properties = Property::where('user_id', Auth::user()->id)->get();

            $images = array();
            //$detail = PropertyDetails::where('property_id', $userProp->id)->get();
            for($i = 0; $i < count($properties); $i++){
                //get the first image of the property
                $props = PropertyImage::where('property_id', $properties[$i]->id)->first();
                array_push($images, $props);
            }

            $properties = DB::table('properties')
            ->join('property_details','property_details.property_id', '=', 'properties.id')
            ->join('locations','locations.property_id', '=', 'properties.id')
            ->select( 'properties.id','properties.proj_name', 'properties.publish','properties.created_at',
            'property_details.price','property_details.property_type','locations.province','locations.city','locations.barangay')
            ->where('user_id', Auth::user()->id)
            ->where(function($query) use($q){
                $query->where('price', 'like', "%{$q}%")
                    ->orWhere('proj_name', 'like', "%{$q}%")
                    ->orWhere('property_type', 'like', "%{$q}%")
                    ->orWhere('province', 'like', "%{$q}%")
                    ->orWhere('barangay', 'like', "%{$q}%")
                    ->orWhere('city', 'like', "%{$q}%")
                    ->orWhere('properties.created_at', 'like', "%{$q}%");
            })->paginate(5);



            return view('agent.property', compact('properties', 'images'));
    }

}
