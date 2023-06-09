<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user())
        {
            if(Auth::user()->role == 'admin' && Auth::user()->status == 'verified'){
                return $next($request);
            }
            else{
                return redirect('/home')->with('fail', 'Access Denied! You are not an admin of this.');
            }
        }
        else
        {
            return redirect('/')->with('fail', 'Please login first.');
        }
    }
}
