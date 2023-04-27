<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use View;
use Redirect;
use Session;
use Response;
use Storage;

class EmployeeController extends Controller
{
    public function index(){
        return view('admin.createEmployee');
    }
    public function getAllEmployees(Request $request){
        if ($request->ajax()) {
            $employee = Employee::orderBy('id', 'asc')->get();
            // != 'resident ->get()
            return response()->json($employee);
        }
    }
    public function storeEmployee(Request $request){
        $encryptedPass = Hash::make($request->password);

        $employee = new Employee;
        $employee->user_id = Auth::user()->id;
        $employee->name = $request->name;
        $employee->birthdate = $request->birthdate;
        $employee->age = $request->age;
        $employee->addressNo = $request->addressNo;
        $employee->street = $request->street;
        $employee->addressZone = $request->addressZone;
        $employee->phoneNum = $request->phoneNum;
        $employee->email = $request->email;
        $employee->position = $request->position;

        $files = $request->file('avatar');
        $employee->avatar = 'storage/employees/'.$files->getClientOriginalName();

        $employee->save();
        $user = new User;
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $encryptedPass;
        $user->role = $request->position;
        $user->status = 'activated';

        $user->save();

        $data=array('status' => 'saved');
        Storage::put('public/employees/'.$files->getClientOriginalName(),file_get_contents($files));

        return response()->json([
            'status' => 200,
            'success' => true, 
            'announcement' => $employee
        ]);
    }

    public function update(Request $request){
        $employer = Employer::find($request->id);

        if(Auth::user()->id != $request->id){
            return response()->json([
                'success' => false, 
                'message' => 'Authorized Users Only.'
            ]);
        }
        $employer->companyName = $request->companyName;
        $employer->companyDesc = $request->companyDesc;
        $employer->company_img = $request->company_img;
        $employer->update();

        return response()->json([
            'success' => true, 
            'message' => 'Employer is updated.'
        ]);
    }
}
