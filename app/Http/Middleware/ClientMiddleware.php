<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
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
        if(Auth::user()->roles->role_type == 'Private' || Auth::user()->roles->role_type == 'Agent'){
            // if(Auth::user()->active !=0){
                return $next($request);
            // }else{
            //     $message = "Your acount has been deactivated! Try to contact the admin to activate your account.";
            //     echo "<script type='text/javascript'>alert('$message');</script>";
            // }

        }else{
            return redirect('/')->with('status', 'You are not allowed to access this link.!');
        }
    }
}
