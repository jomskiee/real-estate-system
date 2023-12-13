<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class MyProfileController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.myProfile', compact('user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'fname' => [ 'string', ],
            'lname' => [ 'string', ],
            'mobile' => ['digits:11'],
            'address' => [ 'string'],
            'email' => ['string', 'email', 'max:255'],
            'avatar' => ['image'],
        ]);
        $user = Auth::user();


        if($request->hasfile('avatar')){
            $destination = 'avatars'. $user->avatar;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $avatarName = time(). '-'. $request->fname. '.'. $request->avatar->extension();
            $request->avatar->move(public_path('avatars'), $avatarName);
            $user->update([
                'avatar' => $avatarName
            ]);
        }
        $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'mobile' => $request->mobile,
            'province' => $request->province,
            'city' => $request->city,
            'barangay' => $request->barangay,
            'email' => $request->email,
        ]);
        return redirect()->back()->with('success', 'Profile successfully updated!');

    }
}
