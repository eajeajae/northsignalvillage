<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employer;
use Auth;
use Storage;

class EmployerController extends Controller
{
    public function index(){
        return view('admin.createEmployer');
    }
    public function getAllEmployers(Request $request){
        if ($request->ajax()) {
            $employers = Employer::orderBy('id', 'asc')->get();
            
            return response()->json($employers);
        }
    }
    public function storeEmployer(Request $request){
        $employer = new Employer;
        $employer->user_id = Auth::user()->id;


        $employer->companyName = $request->companyName;
        $employer->companyDesc = $request->companyDesc;

        $files = $request->file('company_img');
        $employer->company_img = 'storage/employers/'.$files->getClientOriginalName();

        $employer->save();
        $data=array('status' => 'saved');
        Storage::put('public/employers/'.$files->getClientOriginalName(),file_get_contents($files));

        return response()->json([
            'status' => 200,
            'success' => true, 
            'announcement' => $employer
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
