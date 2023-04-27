<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactUs;
use App\Models\User;
use Mail;
use Auth;

class ContactusController extends Controller
{
    public function sendMessage(Request $request){
        $data = [
            'subject' => 'Message Inquiry',
            'name' => $request->name,
            'email' => $request->email,
            'inquiry' => $request->inquiry
        ];
        try {
            Mail::to('abbygalemendoza08@gmail.com')->send(new ContactUs($data));
            return response()->json([
                'data' => $data,
                'status' => 200
            ]); 
        } catch (Exception $th) {
            return response()->json([
                'message' => 'Sorry, something went wrong.',
                'status' => 401
            ]);
          }
    }
}
