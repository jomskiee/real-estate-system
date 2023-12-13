<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyTypes;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FrontEndController extends Controller
{
    //
    public function index(){

        $date = Carbon::now()->toDateString();

        // dd($date);
        $visitor = Visitor::where('date', $date)->increment('visitors_cnt');
        // dd($visitor);
        if($visitor == 0){
            $visitor = new Visitor;
            $visitor->date = Carbon::now();
            $visitor->visitors_cnt = 1;
            $visitor->save();
        }
        $visitors = Visitor::sum('visitors_cnt');
        // dd($visitors);

        $property = Property::where('status', 1)
                ->where('publish', 1)
                ->join('property_details','property_details.property_id', '=', 'properties.id')
                ->join('property_types', 'property_types.id', '=', 'properties.prop_type_id')
                ->join('users','users.id', '=', 'properties.user_id')
                ->select( 'properties.id','properties.user_id','users.fname', 'users.lname', 'users.avatar','properties.slug',
                'properties.proj_name', 'properties.stat_view','properties.created_at',
                'property_details.price', 'property_types.prop_type','property_details.prop_location')
                ->orderBy('properties.stat_view', 'DESC')->limit(6)->get();

         //create an array to store all images
         $images = array();

         for($i = 0; $i < count($property); $i++){
             //get the first image of the property
             $props = PropertyImage::where('property_id', $property[$i]->id)->orderBy('sort', 'ASC')->first();
             array_push($images, $props);
         }

        $latest = Property::where('status', 1)
            ->where('publish', 1)
            ->join('property_details','property_details.property_id', '=', 'properties.id')
            ->join('property_types', 'property_types.id', '=', 'properties.prop_type_id')
            ->join('users','users.id', '=', 'properties.user_id')
            ->select( 'properties.id','properties.user_id','users.fname', 'users.lname', 'users.avatar','properties.slug',
            'properties.proj_name', 'properties.stat_view','properties.created_at',
            'property_details.price', 'property_types.prop_type','property_details.prop_location')
            ->orderBy('properties.created_at', 'DESC')->limit(9)->get();

        //create an array to store all images
        $pics = array();

        for($i = 0; $i < count($latest); $i++){
            //get the first image of the property
            $props = PropertyImage::where('property_id', $latest[$i]->id)->orderBy('sort', 'ASC')->first();
            array_push($pics, $props);
        }

        $test = Testimonial::where('publish', 1)->get();
        $prop = PropertyTypes::all();

        $properties = Property::where('status', 1)->get();
        $users = User::all();

        return view('index', compact('property', 'images', 'test', 'prop', 'latest', 'pics', 'properties', 'users', 'visitors'));
    }


    public function viewAll(){

        $property = Property::where('status', 1)
        ->where('publish', 1)
        ->join('property_details','property_details.property_id', '=', 'properties.id')
        ->join('property_types', 'property_types.id', '=', 'properties.prop_type_id')
        ->join('users','users.id', '=', 'properties.user_id')
        ->select( 'properties.id','properties.user_id','users.fname', 'users.lname', 'users.avatar','properties.slug',
        'properties.proj_name', 'properties.stat_view','properties.created_at','property_details.price',
         'property_types.prop_type', 'property_details.prop_location')
                ->paginate(9);
         //create an array to store all images
         $images = array();

         for($i = 0; $i < count($property); $i++){
             //get the first image of the property
             $props = PropertyImage::where('property_id', $property[$i]->id)->orderBy('sort', 'ASC')->first();
             array_push($images, $props);
         }
         $prop = PropertyTypes::all();

        return view('properties', compact('property', 'images', 'prop'));
    }
    public function viewProp($slug){
        //join all

        Property::where('slug' ,$slug)->increment('stat_view');
        $prop = Property::where('slug' , $slug)
        ->join('users','users.id', '=', 'properties.user_id')
        ->join('clients','clients.user_id', '=', 'properties.user_id')
        ->join('property_details','property_details.property_id', '=', 'properties.id')
        ->select('users.fname', 'users.lname', 'users.avatar','users.email', 'users.mobile',
            'clients.agency_name', 'clients.agency_address', 'clients.office_no',
        'properties.id','properties.publish','properties.proj_name','properties.user_id', 'properties.created_at',
        'property_details.price','property_details.desc','property_details.prop_location')
        ->first();

        $user = Auth::user();
        $propImages = PropertyImage::where('property_id', $prop->id)->orderBy('sort', 'ASC')->get();
        // dd($propImages);
        if($user){
            $fav = $user->favorite_props()->where('property_id', $prop->id)->count();
            return view('property', compact('prop', 'propImages','fav'));
        }else{
            return view('property', compact('prop', 'propImages'));
        }

        // dd($fav);


    }
    public function contact(){

        return view('contact');
    }

    public function sendMessage(Request $request){

        $request->validate([
            'email'=> 'required', 'email',
            'subject' => 'required',
            'name' => 'required',
            'content' => 'required'

        ]);

        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
            'content' => $request->content
        ];

        $to_email = 'jomilendelatorre@gmail.com';

        Mail::send('email',$data, function ($message) use ($to_email, $data){

            $message->to($to_email)->subject('Concern from FindProperty User');
            $message->from($data['email'], $data['subject']);
        });
        return back()->with(['message' => 'Email successfully sent!']);
    }

    public function search(Request $request){

        $q = $request->property_search;
        $prop_type = $request->property_type;

        $prop = PropertyTypes::all();
        // dd($request->all());
        if($q != null || $prop_type != null){
            if($q){

                $property = Property::where('status', 1)
                    ->where('publish', 1)
                    ->join('property_details','property_details.property_id', '=', 'properties.id')
                    ->join('users','users.id', '=', 'properties.user_id')
                    ->join('property_types','property_types.id', '=', 'properties.prop_type_id')
                    ->select( 'properties.id','properties.user_id','users.fname', 'users.lname',
                    'users.avatar','properties.slug','properties.proj_name', 'properties.created_at',
                    'property_details.price','property_types.prop_type','property_details.prop_location')
                    ->where(function($query) use($q){
                        $query->orWhere('price', 'like', "%{$q}%")
                            ->orWhere('proj_name', 'like', "%{$q}%")
                            ->orWhere('prop_type', 'like', "%{$q}%")
                            ->orWhere('prop_location', 'like', "%{$q}%")
                            ->orWhere('fname', 'like', "%{$q}%")
                            ->orWhere('lname', 'like', "%{$q}%");
                    })->paginate(9);
            }
            if($prop_type){
                $property = Property::where('status', 1)
                ->where('publish', 1)
                ->join('property_details','property_details.property_id', '=', 'properties.id')
                ->join('users','users.id', '=', 'properties.user_id')
                ->join('property_types','property_types.id', '=', 'properties.prop_type_id')
                ->select( 'properties.id','properties.user_id','users.fname', 'users.lname',
                'users.avatar','properties.slug','properties.proj_name', 'properties.created_at', 'properties.prop_type_id',
                'property_details.price','property_types.prop_type','property_details.prop_location')
                ->where('prop_type_id', 'like', "%{$prop_type}%")->paginate(9);
            }
            if($q && $prop_type){
                $property = Property::where('status', 1)
                ->where('publish', 1)
                ->join('property_details','property_details.property_id', '=', 'properties.id')
                ->join('users','users.id', '=', 'properties.user_id')
                ->join('property_types','property_types.id', '=', 'properties.prop_type_id')
                ->select( 'properties.id','properties.user_id','users.fname', 'users.lname',
                'users.avatar','properties.slug','properties.proj_name', 'properties.created_at',
                'property_details.price','property_types.prop_type','property_details.prop_location')
                ->where('prop_type', 'like', "%{$prop_type}%")
                ->where(function($query) use($q){
                    $query->orWhere('price', 'like', "%{$q}%")
                        ->orWhere('proj_name', 'like', "%{$q}%")
                        ->orWhere('prop_type', 'like', "%{$q}%")
                        ->orWhere('prop_location', 'like', "%{$q}%")
                        ->orWhere('fname', 'like', "%{$q}%")
                        ->orWhere('lname', 'like', "%{$q}%");
                })->paginate(9);
            }

            $images = array();

            for($i = 0; $i < count($property); $i++){
                //get the first image of the property
                $props = PropertyImage::where('property_id', $property[$i]->id)->orderBy('sort', 'ASC')->first();
                array_push($images, $props);
            }
            return view('properties', compact('property', 'images', 'prop'));
        }
        else{

           return redirect()->route('viewAll');
        }


    }
}
