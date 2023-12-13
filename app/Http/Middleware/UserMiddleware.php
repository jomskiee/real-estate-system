<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->active == 0){

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            $message = "Your acount has been deactivated! Try to contact the admin to activate your account.";
            // echo "<script type='text/javascript'>alert('$message');</script>";

            // return redirect('/');
            return redirect()->route('login')->with('error', $message);
        }
        return $next($request);

    }
}
