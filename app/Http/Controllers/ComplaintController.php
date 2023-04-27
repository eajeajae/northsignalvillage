<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailResidentAboutComplaint;
use App\Mail\EmailResidentAboutFirstHearing;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Complaint;
use App\Models\Myrequest;
use App\Models\Mediation;
use Auth;
use View;
use DB;

class ComplaintController extends Controller
{
    public function index(Request $request){
        $id = Auth::id();
        $user = User::find($id);
        // dd($user);
        return View::make('complaint.create', compact('user'));
    }

    public function create(Request $request){
        $complaint = new Complaint;
        $complaint->caseNo = 'caseno-'.rand(1111,9999);
        $complaint->complainantName = Auth::user()->name;
        $complaint->cAddressno = Auth::user()->addressNo;
        $complaint->cStreet = Auth::user()->street;
        $complaint->cAddresszone = Auth::user()->addressZone;
        $complaint->respondentName = $request->respondentName;
        $complaint->respondentAge = $request->respondentAge;
        $complaint->rAddressno = $request->rAddressno;
        $complaint->rStreet = $request->rStreet;
        $complaint->rAddresszone = $request->rAddresszone;
        $complaint->complaintDesc = $request->complaintDesc;
        $complaint->locationAddressno = $request->locationAddressno;
        $complaint->locationStreet = $request->locationStreet;
        $complaint->complaintWhy = $request->complaintWhy;
        $complaint->complainantPrayer = $request->complainantPrayer;
        $complaint->complaintDate = $request->complaintDate;
        $complaint->complainantAgrees = $request->complainantAgrees;
        $complaint->user_id = Auth::user()->id;
        // dd($complaint);
        $complaint->save();
        
        return response()->json([
            'status' => 200,
            'complaint' => $complaint
        ]);  
    }
    public function show($id){
      $complaint = Complaint::find($id);

      if ($complaint) {
          return response()->json([
              'complaint'=> $complaint
          ]);
      }
      else{
          return response()->json([
              'status'=>404,
              'message'=>'Complaint data not found',
          ]);
      }
  }
  //edit complaint (for resident)
    public function edit($id){
        $complaint = Complaint::find($id);

        if ($complaint) {
            return response()->json([
                'complaint'=> $complaint
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Complaint data not found',
            ]);
        }
    }
    //update complaint (for resident)
    public function update(Request $request){
        $complaint = Complaint::find($request->id);

        $complaint->complainantName = Auth::user()->name;
        $complaint->cAddressno = Auth::user()->addressNo;
        $complaint->cStreet = Auth::user()->street;
        $complaint->cAddresszone = Auth::user()->addressZone;
        $complaint->respondentName = $request->respondentName;
        $complaint->respondentAge = $request->respondentAge;
        $complaint->rAddressno = $request->rAddressno;
        $complaint->rStreet = $request->rStreet;
        $complaint->rAddresszone = $request->rAddresszone;
        $complaint->complaintDesc = $request->complaintDesc;
        $complaint->locationAddressno = $request->locationAddressno;
        $complaint->locationStreet = $request->locationStreet;
        $complaint->complaintWhy = $request->complaintWhy;
        $complaint->complainantPrayer = $request->complainantPrayer;
        $complaint->complaintDate = $request->complaintDate;
        $complaint->complainantAgrees = $request->complainantAgrees;

        $complaint->update();
        
        return response()->json([
            'success' => true,
            'message' => 'Your request is updated!',
            'complaint' => $complaint
        ]);
    }
    public function deleteComplaint($id){
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();
        return response()->json([
            "success" => "Complaint deleted successfully.",
            "complaint" => $complaint,
            "status" => 200
        ]);
    }
    public function getAllComplaints(Request $request){
        if ($request->ajax()) {
            // $complaints = Complaint::orderBy('id', 'asc')->get();
            $complaints = DB::table('complaints')
            ->leftJoin('mediations', 'complaints.id', 'mediations.complaint_id')
            ->select('complaints.id AS id', 'complaints.caseNo as caseNo', 'complaints.complainantName as complainantName', 'complaints.respondentName as respondentName', 'complaints.complaintDesc AS complaintDesc', 'complaints.created_at as created_at', 'mediations.mediationSchedule as mediationSchedule')->get();
            return response()->json($complaints);
        }
    }
    public function viewall(){
      $pendingFilledComplaints = DB::table('complaints')
        ->select('complaints.name')->where('status', 'pending')
        ->count();
        $onProcessFilledComplaints = DB::table('complaints')
        ->select('complaints.name')->where('status', 'on process')
        ->count();
        $doneFilledComplaints = DB::table('complaints')
        ->select('complaints.name')->where('status', 'settled')
        ->count();
        return View::make('complaint.viewall', compact('pendingFilledComplaints', 'onProcessFilledComplaints', 'doneFilledComplaints'));
    }
    public function editComplaint($id){
      $complaint = Complaint::find($id);
      $mediationSchedule = Complaint::with('mediationSchedule')->find($id)->mediationSchedule;
      // dd($mediationSchedule);
      if ($complaint) {
          return response()->json([
              'complaint'=> $complaint,
              'mediationSchedule' => $mediationSchedule
          ]);
      }
      else{
          return response()->json([
              'status'=>404,
              'message'=>'Complaint data not found',
          ]);
      }
    }
    //update complaint (for admin)
    public function updateComplaint(Request $request,$id){
      $complaint = Complaint::find($id);

      $complaint->complainantName = $request->complainantName;
      $complaint->cAddressno = $request->cAddressno;
      $complaint->cStreet = $request->cStreet;
      $complaint->cAddresszone = $request->addressZone;
      $complaint->respondentName = $request->respondentName;
      $complaint->respondentAge = $request->respondentAge;
      $complaint->rAddressno = $request->rAddressno;
      $complaint->rStreet = $request->rStreet;
      $complaint->rAddresszone = $request->rAddresszone;
      $complaint->complaintDesc = $request->complaintDesc;
      $complaint->locationAddressno = $request->locationAddressno;
      $complaint->locationStreet = $request->locationStreet;
      $complaint->complaintWhy = $request->complaintWhy;
      $complaint->complainantPrayer = $request->complainantPrayer;
      $complaint->complaintDate = $request->complaintDate;
      $complaint->complainantAgrees = $request->complainantAgrees;
      $complaint->status = $request->status;

      $userEmail = User::find($request->user_id);

      $update = [
        'subject' => 'Update Regarding your Complaint',
        'name' => $userEmail->name,
        'complaintDesc' => $request->complaintDesc,
        'status' => $request->status,
        'respondentName' => $request->respondentName,
        'locationAddress' => $request->locationAddressno.' '.$request->locationStreet,
      ]; 
      Mail::to($userEmail->email)->send(new EmailResidentAboutComplaint($update));
      
      $complaint->update();
      return response()->json([
          'success' => true,
          'message' => 'Your request is updated!',
          'complaint' => $complaint
      ]);
    }
    public function createSchedule(Request $request, $id){
      $mediation = new Mediation;
      $mediation->complaint_id = $request->complaint_id;
      $mediation->user_id = $request->complaint_user_id;
      $mediation->mediationSchedule = $request->mediationSchedule;
      // dd($mediation);
      $mediation->save();
      $complaint = Complaint::find($id);
      $complaint->status = 'on process';

      $complaint->update();

      $userEmail = User::find($request->complaint_user_id);

      $update = [
        'subject' => 'Update Regarding your Complaint',
        'name' => $userEmail->name,
        'complaintDesc' => $complaint->complaintDesc,
        'status' => $complaint->status,
        'respondentName' => $request->respondentName,
        'locationAddress' => $complaint->locationAddressno.' '.$complaint->locationStreet,
        'mediationSchedule' => $mediation->mediationSchedule,
      ]; 
      Mail::to($userEmail->email)->send(new EmailResidentAboutFirstHearing($update));
      
      return response()->json([
        'status' => 200,
        'mediation' => $mediation,
        'complaint' => $complaint
      ]);  
    }
    public function pending(){
      return view('complaint.pending');
    }
    public function getPendingComplaints(Request $request){
      if ($request->ajax()) {
          $pending = DB::table('complaints')
          ->leftJoin('mediations', 'complaints.id', 'mediations.complaint_id')
          ->select('complaints.id AS id', 'complaints.caseNo as caseNo', 'complaints.complainantName as complainantName', 'complaints.respondentName as respondentName', 'complaints.complaintDesc AS complaintDesc', 'complaints.created_at as created_at', 'mediations.mediationSchedule as mediationSchedule')
          ->where('status', 'pending')
          ->get();
        return response()->json($pending);
      }
    }
    public function onprocess(){
      return view('complaint.onprocess');
    }
    public function getOnProcessComplaints(Request $request){
      if ($request->ajax()) {
          $onprocess = DB::table('complaints')
          ->leftJoin('mediations', 'complaints.id', 'mediations.complaint_id')
          ->select('complaints.id AS id', 'complaints.caseNo as caseNo', 'complaints.complainantName as complainantName', 'complaints.respondentName as respondentName', 'complaints.complaintDesc AS complaintDesc', 'complaints.created_at as created_at', 'mediations.mediationSchedule as mediationSchedule')
          ->where('status', 'on process')
          ->get();
          
          return response()->json($onprocess);
      }
  }
}
