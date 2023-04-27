<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResidentEmailNotification;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Barangayid;
use App\Models\Typeofrequest;
use App\Models\Myrequest;
use View;
use DB;

class BarangayidController extends Controller
{
    public function index(){
        $id = Auth::id();
        $user = User::find($id);
        $typeofrequest = Typeofrequest::Barangayid()->pluck('id');
        $request = Typeofrequest::find($typeofrequest);
        // dd($user);
        return View::make('barangayid.create', compact('user', 'request'));
    }

    public function create(Request $request){
      $barangayid = new Barangayid;
      $barangayid->user_id = Auth::user()->id;
      $barangayid->fullname = Auth::user()->name;
      $barangayid->birthdate = Auth::user()->birthdate;
      $barangayid->contactno = Auth::user()->phoneNum;
      $barangayid->addressNo = Auth::user()->addressNo;
      $barangayid->street = Auth::user()->street;
      $barangayid->addressZone = Auth::user()->addressZone;
      $barangayid->precintNo = $request->precintNo;
      $barangayid->contactperson = $request->contactperson;
      $barangayid->guardianContact = $request->guardianContact;
      $barangayid->guardianAddress = $request->guardianAddress;
      $barangayid->typeofrequest_id = $request->typeofrequest_id;
      if($request->hasFile('id_img')){
        $image = $request->file('id_img');
        $extension = $image->getClientOriginalExtension();
        $imagename = time().'.'.$extension;
        $image->move('storage/users/', $imagename);
        $barangayid->id_img = $imagename;
      }
      $barangayidprice = Typeofrequest::find($request->typeofrequest_id);
      $barangayid->price = $barangayidprice->price;
      $barangayid->save();
      $data=array('status' => 'saved');
      // dd($barangayid);
      return response()->json([
        'status' => 200,
        'barangayid' => $barangayid,
      ]);
    }
    public function show($id){
      $barangayid = Barangayid::find($id);

      if ($barangayid) {
          return response()->json([
              'barangayid'=> $barangayid
          ]);
      }
      else{
          return response()->json([
              'status'=>404,
              'message'=>'Barangay ID data not found',
          ]);
      }   
  }
    public function edit($id){
        $barangayid = Barangayid::find($id);

        if ($barangayid) {
            return response()->json([
                'barangayid'=> $barangayid
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Barangay ID data not found',
            ]);
        }   
    }
    //update barangay id (for resident)
    public function update(Request $request, $id){
        $barangayid = Barangayid::find($id);

        $barangayid->fullname = $request->fullname;
        $barangayid->birthdate = $request->birthdate;
        $barangayid->contactno = $request->contactno;
        $barangayid->addressNo = $request->addressNo;
        $barangayid->street = $request->street;
        $barangayid->addressZone = $request->addressZone;
        $barangayid->precintNo = $request->precintNo;
        $barangayid->contactperson = $request->contactperson;
        $barangayid->guardianContact = $request->guardianContact;
        $barangayid->guardianAddress = $request->guardianAddress;
        if($request->hasFile('id_img')){
            $image = $request->file('id_img');
            $extension = $image->getClientOriginalExtension();
            $imagename = time().'.'.$extension;
            $image->move('storage/users/', $imagename);
            $barangayid->id_img = $imagename;
        }
        $barangayid->update();
        
        return response()->json([
            'success' => true,
            'message' => 'Your request is upated!',
            'barangayid' => $barangayid
        ]);
    }
    public function delete($id){
      $barangayid_request = Barangayid::find($id);
      $barangayid_request->delete();
              
      return response()->json([
        "success" => "Request deleted successfully.",
        "data" => $barangayid_request,
        "status" => 200
      ]);
    }
    //update barangay id request (for admin)
    public function updateRequest(Request $request, $id){
      $barangayid = Barangayid::find($id);

      $barangayid->fullname = $request->fullname;
      $barangayid->birthdate = $request->birthdate;
      $barangayid->contactno = $request->contactno;
      $barangayid->addressNo = $request->addressNo;
      $barangayid->street = $request->street;
      $barangayid->addressZone = $request->addressZone;
      $barangayid->precintNo = $request->precintNo;
      $barangayid->contactperson = $request->contactperson;
      $barangayid->guardianContact = $request->guardianContact;
      $barangayid->guardianAddress = $request->guardianAddress;
      if($request->hasFile('id_img')){
          $image = $request->file('id_img');
          $extension = $image->getClientOriginalExtension();
          $imagename = time().'.'.$extension;
          $image->move('storage/users/', $imagename);
          $barangayid->id_img = $imagename;
      }
      $barangayid->status = $request->status;

      $userEmail = User::find($request->user_id);
      $typeofrequest = Typeofrequest::find($request->typeofrequest_id);

      $update = [
        'subject' => 'Update Regarding your Barangay ID Request',
        'name' => $userEmail->name,
        'typeofdoc' => $typeofrequest->typeofdoc,
        'status' => $request->status
      ]; 
      Mail::to($userEmail->email)->send(new ResidentEmailNotification($update));
      $barangayid->update();
      
      return response()->json([
          'success' => true,
          'message' => 'Your request is upated!',
          'barangayid' => $barangayid
      ]);
  }
  
  public function viewall(){
    $incartbarangayIdRequests = DB::table('barangayids')
      ->select('barangayids.name')->where('status', 'in cart')
      ->count();
    $pendingbarangayIdRequests = DB::table('barangayids')
      ->select('barangayids.name')->where('status', 'pending')
      ->count();
    $donebarangayIdRequests = DB::table('barangayids')
      ->select('barangayids.name')->where('status', 'received')
      ->count();
    return View::make('barangayid.viewall', compact('incartbarangayIdRequests', 'pendingbarangayIdRequests', 'donebarangayIdRequests'));
  }
  public function getAllBarangayids(Request $request){
      if ($request->ajax()) {
          $barangayids = Barangayid::orderBy('id', 'DESC')->get();
          
          return response()->json($barangayids);
      }
  }
  public function pending(){
    return view('barangayid.pending');
  }
  public function getPendingBarangayids(Request $request){
    if ($request->ajax()) {
        $pending = DB::table('barangayids')
        ->where('status', 'pending')
        ->get();
        
        return response()->json($pending);
    }
  }
}