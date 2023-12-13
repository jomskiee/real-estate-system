<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Favorites;
use App\Models\Property;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddFavorite extends Controller
{
    //
    public function __construct()
	{
		$this->middleware('auth');
	}


    public function store($id)
    {
        $user = Auth::user();
        $fav = $user->favorite_props()->where('property_id', $id)->count();

        if($fav == 0){

            $user->favorite_props()->attach($id);

            return redirect()->back()->with(['success', 'Property successfully added from your favorite list!']);
        }else{

            $user->favorite_props()->detach($id);
            return redirect()->back()->with(['success', 'Property successfully removed from your favorite list!']);
        }

    }
    public function report(Request $request, $id){

        $request->validate([
            'subject' =>  ['required'],
            'desc' =>  ['required'],
        ]);


        $user = Auth::user();

        $count = $user->reports()->where('property_id', $id)->count();
        $prop = Property::find($id);

        // dd($count);

        if($count == 0){

            $report = new Report;
            $report->user_id = $user->id;
            $report->property_id = $id;
            $report->client_id = $prop->user_id;
            $report->subject = $request->subject;
            $report->desc = $request->desc;
            $report->save();

            return redirect()->back()->with(['success', 'Report successfully submitted!']);
        }
        else{
            return redirect()->back()->with(['error', 'You submitted the report already!']);
        }
    }


}
