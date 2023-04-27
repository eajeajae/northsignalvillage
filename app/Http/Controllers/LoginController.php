<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use Redirect;

class LoginController extends Controller
{
    public function postLogin(Request $request){
        $data = $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);
        $user = User::where('email', $data['email'])->first();
        if (auth()->attempt(array('email' => $request->input('email'), 'password' => $request->input('password'), 'status' => 'verified')))
        {

            if (auth()->user()->role == 'admin') {
              $token = $user->createToken('techserviceapiLogin')->plainTextToken;
              return redirect()->route('admin.dashboard')->with('success', 'You are now logged in as administrator.');
                // return response()->json([
                //   'status' => 200, 
                //   'message' => 'you are now logged in!'
                // ]);
            } 
            else {
              $token = $user->createToken('techserviceapiLogin')->plainTextToken;
              return redirect()->route('landingpage.index')->with('success', 'You are now logged in as resident.');
              // return response()->json([
              //   'status' => 200, 
              //   'message' => 'you are now logged in as resident!'
              // ]);
            }
        }
        else{
            // dd('hello');
            return redirect()->route('user.getLogin')
                ->with('fail','Email and password does not match');
        }
    }
}
