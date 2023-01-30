<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class CheckAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$user = $request->user();
        // if($user && $user->banned ==1 && Auth::user()->is_admin == 1){
        //     $this->guard()->logout();
        //     $request->session()->flush();
        //     $request->session()->regenerate();
        //     return redirect('/banned/');
        // }

        if (!(Auth::check() and (Auth::user()->role == "admin" || Auth::user()->role == "Employee" ) and Auth::user()->status == 1)) {
            return redirect('/login');
        }

        return $next($request);
    }
}
