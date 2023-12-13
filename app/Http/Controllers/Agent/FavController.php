<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Report;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;



class FavController extends Controller
{


    public function favorites(){
        $users = DB::table('favorite_prop')->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        // dd($user);
        $property = array();
        // dd($props);
        $images = array();

        foreach($users as $user){
            $prop = DB::table('properties')->where('properties.id', $user->property_id)
             ->join('property_details','property_details.property_id', '=', 'properties.id')
            ->join('property_types', 'property_types.id', '=', 'properties.prop_type_id')
            ->join('users', 'users.id', '=', 'properties.user_id')
            ->select('properties.id','properties.user_id','properties.status', 'users.fname', 'users.lname','properties.slug','properties.proj_name',
            'property_details.price', 'property_details.prop_location','property_types.prop_type')
            ->first();
            // dd($prop->status);
            // dd($prop);
           if($prop){
                if($prop->status == 1){
                    array_push($property, $prop);
                }
                if($prop->status == 1){
                    $image = PropertyImage::where('property_id', $prop->id)->orderBy('sort', 'ASC')->first();
                    array_push($images, $image);
                }
           }
        }

        $props = $this->paginate($property);

        // dd($props);
        return view('agent.favs', compact('props', 'images'));
    }

    public function delFav($id){

        $user = Auth::user();
        $user->favorite_props()->detach($id);

        return redirect()->back()->with(['success', 'Favorite has been deleted']);
    }
    public function repProp($id){

        $rep = Report::where('property_id', $id)->first();
        $propImages = PropertyImage::where('property_id', $id)->get();
        return view('agent.repProp', compact('rep', 'propImages'));
    }

    public function report(){

        //get all reports of the property of user

        $property = Property::where('user_id', Auth::user()->id)->get();

        //create an array to store all images of the property of the user
        $reps = array();
        //$detail = PropertyDetails::where('property_id', $userProp->id)->get();
        for($i = 0; $i < count($property); $i++){
            //get the first image of the property
            $report = Report::where('property_id', $property[$i]->id)->first();

            if($report){
                array_push($reps, $report);
            }

        }
        $reports = collect($reps)->sortBy('created_at')->reverse();
        // dd($reports);

        $images = array();

        for($i = 0; $i < count($property); $i++){
            //get the first image of the property
            $props = PropertyImage::where('property_id', $property[$i]->id)->orderBy('sort', 'ASC')->first();
            array_push($images, $props);
            // dd($props);
        }
        // dd($images);
        return view('agent.report', compact('reports', 'images'));
    }

    public function paginate($items, $perPage = 9, $page = null, $options = []){

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $paginator =  new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        return $paginator->setPath(route('favAge'));
    }
}
