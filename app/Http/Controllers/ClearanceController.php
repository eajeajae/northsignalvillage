<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResidentEmailNotification;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Clearance;
use App\Models\Typeofrequest;
use App\Models\Myrequest;
use App\Models\Clearancerequest;
use Auth;
use View;
use DB;

class ClearanceController extends Controller
{
    public function index(Request $request){
        $id = Auth::id();
        $user = User::find($id);
        $requestid = Typeofrequest::Clearance()->pluck('id');
        $typeofrequest_id = Typeofrequest::find($requestid);
        // dd($request);
        return View::make('clearance.create', compact('user', 'typeofrequest_id'));
    }

    public function create(Request $request){
      if($request->input('typeofrequest_id')){
        foreach ($request->typeofrequest_id as $typeofrequest_id) 
        {
          $typeofrequest = Typeofrequest::find($typeofrequest_id);
          $clearance = DB::table('clearances')->insert([
            'control_no' => 'clearance-'.rand(1111,9999),
            'user_id' => Auth::user()->id,
            'purpose' => $request->purpose,
            'isRegistered' => $request->isRegistered,
            'havePendingCase' => $request->havePendingCase,
            'name' => Auth::user()->name,
            'gender' => Auth::user()->gender,
            'birthdate' => Auth::user()->birthdate,
            'p_birth' => $request->p_birth,
            'nationality' => $request->nationality,
            'contact_num' => Auth::user()->phoneNum,
            'c_status' => $request->c_status,
            'addressNo' => Auth::user()->addressNo,
            'street' => Auth::user()->street,
            'addressZone' => Auth::user()->addressZone,
            'provincialAddress' => $request->provincialAddress,
            'yearLiving' => $request->yearLiving, 
            'areYouSure' => $request->areYouSure,
            'typeofrequest_id' => $typeofrequest_id,
            'typeofdoc' => $typeofrequest->typeofdoc,
            'price' => $typeofrequest->price
          ]);
        }	
      }
				return response()->json([
					'status' => 200,
					'success' => true,
					'message' => 'Thank you! Your request is submitted Successfuly!',
					'clearance' => $clearance,
				]);
        
        
    }
    public function show(Request $request, $id){
      $clearance = Clearance::find($id);
      if ($clearance) {
          return response()->json([
              'clearance'=> $clearance
          ]);
      }
      else{
          return response()->json([
              'status'=>404,
              'message'=>'Clearance form not found',
          ]);
      }
    }
    public function edit(Request $request, $id){
        $clearance = Clearance::find($id);
        if ($clearance) {
            return response()->json([
                'clearance'=> $clearance
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Clearance form not found',
            ]);
        }
    }
    //update clearance request ( for resident)
    public function update(Request $request, $id){
      $clearance = Clearance::find($id);
      
      $clearance->businessName = $request->businessName;
      $clearance->purpose = $request->purpose;
      $clearance->isRegistered = $request->isRegistered;
      $clearance->havePendingCase = $request->havePendingCase;
      $clearance->name = $request->name;
      $clearance->gender = $request->gender;
      $clearance->birthdate = $request->birthdate;
      $clearance->p_birth = $request->p_birth;
      $clearance->nationality = $request->nationality;
      $clearance->contact_num = $request->contact_num;
      $clearance->c_status = $request->c_status;
      $clearance->addressNo = $request->addressNo;
      $clearance->street = $request->street;
      $clearance->addressZone = $request->addressZone;
      $clearance->businessAddress = $request->businessAddress;
      $clearance->provincialAddress = $request->provincialAddress;
      $clearance->yearLiving = $request->yearLiving;
      $clearance->areYouSure = $request->areYouSure;
      $clearance->typeofrequest_id = $request->typeofrequest_id;
      $typeofrequest = Typeofrequest::find($request->typeofrequest_id);
      $clearance->typeofdoc = $typeofrequest->typeofdoc;
      $clearance->price = $typeofrequest->price;
      $clearance->update();
      // dd($clearance);
      return response()->json([
          'success' => true,
          'message' => 'Your request is updated!',
          'clearance' => $clearance
      ]);
  }
  //update clearance (for admin)
    public function updateClearance(Request $request, $id){
      $clearance = Clearance::find($id);
        
      $clearance->businessName = $request->businessName;
      $clearance->purpose = $request->purpose;
      $clearance->isRegistered = $request->isRegistered;
      $clearance->havePendingCase = $request->havePendingCase;
      $clearance->name = $request->name;
      $clearance->gender = $request->gender;
      $clearance->birthdate = $request->birthdate;
      $clearance->p_birth = $request->p_birth;
      $clearance->nationality = $request->nationality;
      $clearance->contact_num = $request->contact_num;
      $clearance->c_status = $request->c_status;
      $clearance->addressNo = $request->addressNo;
      $clearance->street = $request->street;
      $clearance->addressZone = $request->addressZone;
      $clearance->businessAddress = $request->businessAddress;
      $clearance->provincialAddress = $request->provincialAddress;
      $clearance->yearLiving = $request->yearLiving;
      $clearance->areYouSure = $request->areYouSure;
      $clearance->typeofrequest_id = $request->typeofrequest_id;

      $typeofrequest = Typeofrequest::find($request->typeofrequest_id);
      $clearance->typeofdoc = $typeofrequest->typeofdoc;
      $clearance->price = $typeofrequest->price;
      $clearance->status = $request->status;

      $userEmail = User::find($request->user_id);

      $update = [
        'subject' => 'Update Regarding your Clearance Request',
        'name' => $userEmail->name,
        'typeofdoc' => $typeofrequest->typeofdoc,
        'status' => $request->status
      ]; 
      Mail::to($userEmail->email)->send(new ResidentEmailNotification($update));
      
      $clearance->update();
      // dd($clearance);
      return response()->json([
        'status' => 200,
        'success' => true,
        'message' => 'Your request is updated!',
        'clearance' => $clearance
      ]);
    }

    public function delete($id){
      $clearance = Clearance::find($id);
      $clearance->delete();
      // dd($typeofrequest);
        return response()->json([
          "success" => "Request deleted successfully.",
          "data" => $clearance,
          "status" => 200
      ]);
    }
    public function viewall(){
      $incartclearanceRequests = DB::table('clearances')
        ->select('clearances.name')->where('status', 'in cart')
        ->count();
        $pendingclearanceRequests = DB::table('clearances')
        ->select('clearances.name')->where('status', 'pending')
        ->count();
        $doneclearanceRequests = DB::table('clearances')
        ->select('clearances.name')->where('status', 'received')
        ->count();
        return View::make('clearance.viewall', compact('incartclearanceRequests', 'pendingclearanceRequests', 'doneclearanceRequests'));
    }
    public function getAllClearances(Request $request){
        if ($request->ajax()) {
          $clearance = Clearance::orderBy('id', 'DESC')->get();
            
            return response()->json($clearance);
        }
    }
  public function pending(){
    return view('clearance.pending');
  }
  public function getPendingClearances(Request $request){
      if ($request->ajax()) {
          $pending = DB::table('clearances')
          ->where('status', 'pending')
          ->get();
          
          return response()->json($pending);
      }
  }
}
