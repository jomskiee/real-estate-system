<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgencyController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $this->validate($request,[
            'agency_name' => 'string',
            'agency_address' => 'string',
            'office_no' => 'digits:11',
        ]);
        $user = Auth::user()->id;
        $agency = Agency::where('user_id', $user)->first();
        //dd($agency);

        if($request->agency_type === 0){
            $agency->update([
                'user_id' => $user,
                'agency_type' => 0,
                'agency_name' => null,
                'agency_address' => null,
                'office_no' => null
            ]);
        }else{
            $agency->update([
                'user_id' => $user,
                'agency_type' => $request->agency_type,
                'agency_name' => $request->agency_name,
                'agency_address' => $request->agency_address,
                'office_no' => $request->office_no
            ]);
        }

        return redirect()->back()->with('success', 'Agency has been updated');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->id;
        $agency = Agency::where('user_id', $user)->first();
        return view('agent.agency', compact('agency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $user = Auth::user()->id;

        $agency = Agency::where('user_id', $user)->first();

        // return $request->all();
        if($request->agency_type == 0){

            $agency->update([
                'user_id' => $user,
                'agency_type' => 0,
                'agency_name' => null,
                'agency_address' => null,
                'office_no' => null
            ]);


        }else{
            $this->validate($request,[
                'agency_name' => 'string',
                'agency_address' => 'string',
                'office_no' => 'digits:11',
            ]);

            $agency->update([
                'user_id' => $user,
                'agency_type' => $request->agency_type,
                'agency_name' => $request->agency_name,
                'agency_address' => $request->agency_address,
                'office_no' => $request->office_no
            ]);
        }

        return redirect()->back()->with('success', 'Agency has been updated');

    }

}
