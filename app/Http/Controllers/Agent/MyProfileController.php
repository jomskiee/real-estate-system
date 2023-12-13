<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Role;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MyProfileController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        // dd($user);
        $roles = Role::where('role_type', 'Private')->orWhere('role_type', 'Agent')->get();

        $client = Client::where('user_id', $user->id)->first();

        $test = Testimonial::where('user_id', $user->id)->first();
        // dd($test);

        return view('agent.userProfile', compact('user' ,'roles', 'client', 'test'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return $request->all();
        // dd($request->all());
        $this->validate($request,[
            'firstname' => [ 'string', ],
            'lastname' => [ 'string', ],
            'mobile' => ['digits:11'],
            'email' => ['string', 'email'],


        ]);
        $user = Auth::user();
        $user->fname = $request->firstname;
        $user->lname = $request->lastname;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->province = $request->province;
        $user->city = $request->city;
        $user->barangay = $request->barangay;
        $user->role_id = $request->role_id;
        $user->save();

        $client = Client::where('user_id', $user->id)->first();
        $client->agency_name = $request->agency_name;
        $client->agency_address = $request->agency_address;
        $client->office_no = $request->office_no;
        $client->save();

        $roles = Role::where('role_type', 'Private')->orWhere('role_type', 'Agent')->get();
        if($request->testimonial != NULL){
            // dd($request->testimonial);
            $this->validate($request,['testimonial' => 'max:200']);
            // $request->testimonial->validate('max:200');
            $test = Testimonial::where('user_id', $user->id)->first();

            if($test){
                $test->testimonial = $request->testimonial;
                $test->publish = 0;
                $test->save();
            }else{
                $test = new Testimonial;
                $test->user_id = $user->id;
                $test->testimonial = $request->testimonial;
                $test->save();
            }
        }
        else{
            $test = array();
        }
        // dd($test);
        return view('agent.userProfile', compact('user', 'roles', 'client','test'))->with('success', 'Profile successfully updated!');



    }

}
