<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Helpers\Helper;
use View;
use Redirect;
use Session;
use Response;
use Storage;

class AuthController extends Controller
{
    public function getLogin(){
        return view('user.login');
    }

    public function login(Request $request){
        $users = $request->only(['email', 'password']);

        if(!$token=auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => 'verified'])){
            // return response()->json([
            //     'success' => false,
            //     'message' => 'Invalid user information'
            // ]);
            return response()->json([
                'status' => 401
            ]);
        }
        return response()->json([
            'status' => 200,
            'success' => true, 
            'token' => $token,
            'user' => Auth::user()
        ]);
    }

    public function getRegister(){
        return view('user.register');
    }
    
    public function register(Request $request){
        $encryptedPass = Hash::make($request->password);

        $user = new User;
        try {
            $user->email = $request->email;
            $user->password = $encryptedPass;

            $user->save();
            $data=array('status' => 'saved');

            return response()->json([
              'success' => true,
              'status' => 200
          ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }

    }

    public function getLogout(){
        Auth::logout();
        return redirect('/')->with('success', 'You are now logged out!');
    }

    public function residentInfo(Request $request){
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $valid_id = '';

        if($request->valid_id = ''){
            $valid_id = time().'jpg';
            file_put_contents('storage/users/'.$valid_id,base64_decode($request->valid_id));
            $user->valid_id = $valid_id;
        }
        $user->update();

        return responde()->json([
            'success' => true, 
            'status' => 200,
            'valid_id' => $valid_id
        ]);
    }
}
