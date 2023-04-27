<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Storage;
use Auth;
use View;
use DB;

class AdminController extends Controller
{
    public function viewall(){
        return view('admin.viewall');
    }
    public function getAllAdmins(Request $request){
        if ($request->ajax()) {
            $admins = User::where('role', 'admin')
            ->orWhere('role', 'super admin')
            ->orWhere('role', 'regular employee')
            ->orderBy('id', 'DESC')->get();
            
            return response()->json($admins);
        }
    }
    public function store(Request $request){
        $encryptedPass = Hash::make($request->password);

        $user = new User;
        $user->name = $request->name;
        $user->birthdate = $request->birthdate;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->addressNo = $request->addressNo;
        $user->street = $request->street;
        $user->addressZone = $request->addressZone;
        $user->phoneNum = $request->phoneNum;
        $user->email = $request->email;
        $user->password = $encryptedPass;
        $user->role = $request->role;
        $user->status = 'activate';
        $files = $request->file('avatar');
        $user->avatar = 'storage/users/'.$files->getClientOriginalName();
        // dd($user);
        $user->save();

        $data=array('status' => 'saved');
        Storage::put('public/users/'.$files->getClientOriginalName(),file_get_contents($files));

        return response()->json([
            'status' => 200,
            'success' => true, 
            'user' => $user
        ]);
    }
    public function edit($id){
        $admin = User::find($id);

        if ($admin) {
            return response()->json([
                'admin'=> $admin
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Admin data not found',
            ]);
        }    
    }
    public function update(Request $request, $id){
        $user = User::find($id);
        $user->status = $request->status;
        $user->update();

        return response()->json([
            'status' => 200,
            'success' => true, 
            'user' => $user
        ]);
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            "success" => "Admin/employee has been deleted successfully.",
            "user" => $user,
            "status" => 200
        ]);
    }
}
