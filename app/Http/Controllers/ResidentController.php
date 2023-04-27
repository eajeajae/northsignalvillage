<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifiedAccountNotification;
use App\Mail\DeletedAccount;
use App\Mail\DeactivatedAccountNotification;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Requestdocument;
use Auth;
use View;
use DB;

class ResidentController extends Controller
{
    public function getMyProfile(Request $request){
        $id = Auth::id();
        $user = User::find($id);
				$certificaterequests = DB::table('certificates')
				->select('id', 'control_no', 'typeofdoc', 'status')
				->where('user_id', Auth::id())
				->paginate(5);
        $clearancerequests = DB::table('clearances')
				->select('id', 'control_no', 'typeofdoc', 'status')
				->where('user_id', Auth::id())
				->paginate(5);
        $barangayidrequests = DB::table('barangayids')
				->select('id', 'status')
				->where('user_id', Auth::id())
				->paginate(5);
        $filedcomplaints = DB::table('complaints')
				->select('id', 'caseNo', 'complaintDesc', 'status')
				->where('user_id', Auth::id())
				->paginate(5);
        $scholarshipapplications = DB::table('scholarships')
        ->leftjoin('comments', 'comments.scholarship_id', '=', 'scholarships.id')
				->select('scholarships.id AS id', 'comments.comment AS comment', 'scholarships.status')
				->where('scholarships.user_id', Auth::id())
				->paginate(5);
        $jobapplications = DB::table('applicants')
        ->leftjoin('joboffers', 'joboffers.id', '=', 'applicants.joboffer_id')
        ->leftjoin('employers', 'employers.id', '=', 'applicants.employer_id')
				->select('applicants.id AS id', 'joboffers.job AS job', 'employers.companyName', 'applicants.status AS status')
				->where('applicants.user_id', Auth::id())
				->paginate(5);
        return View::make('resident.profile', compact(
          'user', 
          'certificaterequests', 
          'clearancerequests', 
          'barangayidrequests',
          'filedcomplaints',
          'scholarshipapplications',
          'jobapplications'
        ));
    }
    public function register(Request $request){
        $encryptedPass = Hash::make($request->password);

        $user = new User;
        
        $user->name = $request->name;
        
        if($request->hasFile('valid_id')){
            $file = $request->file('valid_id');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/validId/', $filename);
            $user->valid_id = $filename;
        }
        $user->email = $request->email;
        $user->password = $encryptedPass;

        $user->save();
        $data=array('status' => 'saved');

        return redirect()->route('user.getLogin')->with('success', 'Please wait for the email notification if the barangay official verified your account');

    }
    public function editmyProfile(Request $request){
      $user = User::find(Auth::id());

      if ($user) {
        return response()->json([
          'user'=> $user
        ]);
      }
      else{
        return response()->json([
          'status'=>404,
          'message'=>'user data not found',
        ]);
      }
    }
    public function updatemyProfile(Request $request){
		  $user_id = Auth::id();
      $user = User::findOrFail($user_id);
		
      $user->name = $request->name;
      $user->age = $request->age;
      $user->birthdate = $request->birthdate;
      $user->phoneNum = $request->phoneNum;
      $user->gender = $request->gender;
      $user->addressNo = $request->addressNo;
      $user->street = $request->street;
      $user->addressZone = $request->addressZone;

      if($request->hasFile('avatar')){
        $file = $request->file('avatar');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('storage/users/', $filename);
        $user->avatar = $filename;
      }
      // $files = $request->file('avatar');
      // $user->avatar = 'storage/users/'.$files->getClientOriginalName();
      // dd($user);
      $user->update();
      $data=array('status' => 'saved');
      // Storage::put('public/users/'.$files->getClientOriginalName(),file_get_contents($files));
        
      return response()->json([
        'status' => 200,
        'success' => true,
        'message' => 'Your profile is upated!',
        'user' => $user
      ]);
    }
    public function setting(){
      $id = Auth::id();
      $user = User::find($id);
      // dd($user);
      return View::make('resident.setting', compact('user'));
    }
    public function viewall(){
      $notVerifiedResidents = DB::table('users')
      ->select('users.name')->where('status', 'not verified')
      ->where('role', 'resident')
      ->count();
      $verifiedResidents = DB::table('users')
      ->select('users.name')->where('status', 'verified')
      ->where('role', 'resident')
      ->count();
      return View::make('resident.viewall', compact('notVerifiedResidents', 'verifiedResidents'));
    }
    public function getAllResidents(Request $request){
      if ($request->ajax()) {
        $residents = User::where('role', 'resident')->orderBy('id', 'DESC')->get();
            
        return response()->json($residents);
      }
    }
    // public function getAllMyrequests(Request $request){
    //     if ($request->ajax()) {
    //         $id = Auth::id();
    //     $user = User::find($id);
    //     $user_request = Requestdocument::with('myrequests', 'userRequests')
    //     ->leftjoin('mods', 'mods.id', '=', 'requestdocuments.mod_id')
    //         ->where('user_id', $user['id'])
    //         ->get();
            
    //         return response()->json($user_request);
    //     }
    // }

    //for admin
    public function edit($id){
      $resident = User::find($id);

      if ($resident) {
        return response()->json([
          'resident'=> $resident
        ]);
      }
      else{
        return response()->json([
          'status'=>404,
          'message'=>'Resident data not found',
        ]);
      }
    }
    public function update(Request $request, $id){
      $resident = User::find($id);
      $resident->status = $request->status;

      if($request->status == 'verified'){
        $update = [
          'name' => $resident->name,
          'status' => $request->status
        ]; 
        Mail::to($resident->email)->send(new VerifiedAccountNotification($update));
        
        $resident->update();
      }
      else{
        $update = [
          'name' => $resident->name,
          'status' => $request->status
        ]; 
        Mail::to($resident->email)->send(new DeactivatedAccountNotification($update));
        
        $resident->update();
      }
      

      return response()->json([
        'status' => 200, 
        'resident' => $resident
      ]);
    }
		public function notverifiedResidents(){
      return view('resident.notverified');
    }
    public function getNotverifiedResidents(Request $request){
        if ($request->ajax()) {
            $notverified = DB::table('users')
            ->where('status', 'not verified')
            ->where('role', 'resident')
            ->get();
            
            return response()->json($notverified);
        }
    }
    public function verifiedResidents(){
      return view('resident.verified');
    }
    public function getVerifiedResidents(Request $request){
        if ($request->ajax()) {
            $verified = DB::table('users')
            ->where('status', 'verified')
            ->where('role', 'resident')
            ->get();
            
            return response()->json($verified);
        }
    }
    public function deleteResident($id){
        $user = User::findOrFail($id);
        $update = [
          'name' => $user->name,
        ]; 
        Mail::to($user->email)->send(new DeletedAccount($update));
        $user->delete();
        return response()->json([
            "success" => "User Account has been deleted successfully.",
            "user" => $user,
            "status" => 200
        ]);

    }
}
