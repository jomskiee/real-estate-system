<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function showLoginForm()
    {
        $previousURL = url()->previous();
        $baseURL = url()->to('/');

        if($previousURL != $baseURL.'/login'){
            session()->put('url.intended', $previousURL);
        }
        return view('auth.login');
    }
    // protected function credentials(Request $request)
    // {
    //     // return $request->only($this->username(), 'password');
    //     $credentials = $request->only($this->username(), 'password');
    //     $credentials['active'] = 1;
    //     // if($credentials != 1){
    //     //     $message = "";
    //     //     echo "<script type='text/javascript'>alert('$message');</script>";

    //     //     return redirect('/');
    //     // }
    //     return $credentials;
    // }
    public function authenticated(Request $request, $user){
        //admin
        if(Auth::user()->roles->role_type == 'Administrator'){

            return redirect('/dashboard');

        }
        //client
        if(Auth::user()->roles->role_type == 'Private' || Auth::user()->roles->role_type == 'Agent'){

            if(Auth::check() && Auth::user()->active == 0){

                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                $message = "Your acount has been deactivated! Try to contact the admin to activate your account.";
                // echo "<script type='text/javascript'>alert('$message');</script>";

                // return redirect('/');
                return redirect()->route('login')->with('error', $message);
            }
            else{
                $this->showLoginForm();
            }


        }
        // return back()->withErrors([
        //     'email' => 'Your acount has been deactivated! Try to contact the admin to activate your account.',
        // ]);

    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
