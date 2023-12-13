<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function _construct(){

        $this->middleware('auth');
    }
    public function change_password(Request $request)
    {
        $user = Auth::user();

        $userPassword = $user->password;

        $request->validate([
            'old_password' =>  'required',
            'password' =>  'required|same:confirm_password|min:6',
            'confirm_password' => 'required'
        ]);

        if (Hash::check($request->old_password, $userPassword)) {

            $user->password = Hash::make($request->password);

            $user->save();

            return redirect()->back()->with('success','Password successfully updated');


        }else{
            return redirect()->back()->with(['error'=>'Old password is incorrect!']);
        }


    }

    public function cropImage(Request $request){

        if($request->ajax()){

            $user = Auth::user();

            $image = $request->avatar;

            $destination = 'avatars'. $user->avatar;
            if(File::exists($destination)){
                File::delete($destination);
            }

            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $image = base64_decode($image);

            $avatarName = $user->fname. '.jpeg';
            $path = public_path('avatars/'.$avatarName);

            file_put_contents($path, $image);

            $user->update([
                'avatar' => $avatarName,
            ]);
            $url = url('/avatars/'.$avatarName);


        }
         return $url;

    }
}
