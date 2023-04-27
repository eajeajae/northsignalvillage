<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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

    public function authenticated(){
        if(auth()->attempt(array('status' => 'verified')))
        {
            if (auth()->user()->role == 'admin') {
                return redirect('/dashboard')->with('success', 'Welcome to dashboard');
            } 
            else if (auth()->user()->role == 'resident' ) {
                return redirect('/home')->with('success', 'You are now logged in');
            }
            else {
                return redirect('/')->with('fail', 'You are not yet verified');
            }
        }
        // if(Auth::user()->role == 'admin'){
        //     return redirect('/dashboard')->with('success', 'Welcome to dashboard');
        // }
        // else if(Auth::user()->role == 'resident'){
        //     return redirect('/home')->with('success', 'You are now logged in');
        // }
        // else{
        //     return redirect('/')->with('fail', 'You are not yet verified');
        // }
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
