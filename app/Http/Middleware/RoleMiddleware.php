<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // if(Auth::check()){
        //     if(Auth::user()->role == 'admin'){
        //         return redirect()->route('admin.dashboard');
        //     }
        //     else{
        //         return redirect()->route('landingpage.index');
        //     }
        // }
        // else{
        //     return redirect()->route('login')->with('fail', 'You do not have an account or it is not verified yet.');
        // }
        $user = Auth::user();
        foreach($roles as $role) {
            if($user->role == $role){
                return $next($request);
            }
            else{
              return redirect('/')->with('fail', 'You do not have an account. Please register first.');
            }
        }
        return redirect('/')->with('fail', 'You do not have an account. Please register first.');
    }
}
