<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResidentEmailNotification;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Certificate;
use App\Models\Certificaterequest;
use App\Models\Typeofrequest;
use Auth;
use View;
use DB;

class CertificateController extends Controller
{
    public function index(Request $request){
        $id = Auth::id();
        $user = User::find($id);
        $requestid = Typeofrequest::Certificate()->pluck('id');
        $typeofrequest_id = Typeofrequest::find($requestid);
        // dd($certificates);
        return View::make('certificate.create', compact('user', 'typeofrequest_id'));
    }

    public function create(Request $request){
        if($request->input('typeofrequest_id')){
          foreach ($request->typeofrequest_id as $typeofrequest_id) 
					{
            $typeofrequest = Typeofrequest::find($typeofrequest_id);
            $certificate = DB::table('certificates')->insert([
              'control_no' => 'certificate-'.rand(1111,9999),
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
            'certificate' => $certificate,
            'success' => true,
            'message' => 'Thank you! Your request is submitted Successfuly!',
        ]);
    }
    public function show(Request $request, $id){
      $certificate = Certificate::find($id);
      if ($certificate) {
          return response()->json([
              'certificate'=> $certificate
          ]);
      }
      else{
          return response()->json([
              'status'=>404,
              'message'=>'Certificate data not found',
          ]);
      }
  }
    public function editCertificate(Request $request, $id){
        $certificate = Certificate::find($id);
        if ($certificate) {
            return response()->json([
                'certificate'=> $certificate
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Certificate data not found',
            ]);
        }
    }
    //update certificate (for resident)
    public function updateCertificate(Request $request, $id){
        $certificate = Certificate::find($id);
        $certificate->purpose = $request->purpose;
        $certificate->isRegistered = $request->isRegistered;
        $certificate->havePendingCase = $request->havePendingCase;
        $certificate->name = $request->name;
        $certificate->gender = $request->gender;
        $certificate->birthdate = $request->birthdate;
        $certificate->p_birth = $request->p_birth;
        $certificate->nationality = $request->nationality;
        $certificate->contact_num = $request->contact_num;
        $certificate->c_status = $request->c_status;
        $certificate->addressNo = $request->addressNo;
        $certificate->street = $request->street;
        $certificate->addressZone = $request->addressZone;
        $certificate->provincialAddress = $request->provincialAddress;
        $certificate->yearLiving = $request->yearLiving;
        $certificate->areYouSure = $request->areYouSure;
        $certificate->typeofrequest_id = $request->typeofrequest_id;

        $typeofrequest = Typeofrequest::find($request->typeofrequest_id);
        $certificate->typeofdoc = $typeofrequest->typeofdoc;

        $certificate->update();
        return response()->json([
          'status' => 200,
          'success' => true,
          'message' => 'Your request is upated!',
          'certificate' => $certificate
        ]);
    }
    //update certificate (for admin)
    public function updateThisCertificate(Request $request, $id){
      $certificate = Certificate::find($id);
      $certificate->purpose = $request->purpose;
      $certificate->isRegistered = $request->isRegistered;
      $certificate->havePendingCase = $request->havePendingCase;
      $certificate->name = $request->name;
      $certificate->gender = $request->gender;
      $certificate->birthdate = $request->birthdate;
      $certificate->p_birth = $request->p_birth;
      $certificate->nationality = $request->nationality;
      $certificate->contact_num = $request->contact_num;
      $certificate->c_status = $request->c_status;
      $certificate->addressNo = $request->addressNo;
      $certificate->street = $request->street;
      $certificate->addressZone = $request->addressZone;
      $certificate->provincialAddress = $request->provincialAddress;
      $certificate->yearLiving = $request->yearLiving;
      $certificate->areYouSure = $request->areYouSure;
      $certificate->typeofrequest_id = $request->typeofrequest_id;

      $typeofrequest = Typeofrequest::find($request->typeofrequest_id);
      $certificate->typeofdoc = $typeofrequest->typeofdoc;
      $certificate->status = $request->status;

      $userEmail = User::find($request->user_id);

      $update = [
        'subject' => 'Update Regarding your Certificate Request',
        'name' => $userEmail->name,
        'typeofdoc' => $typeofrequest->typeofdoc,
        'status' => $request->status
      ]; 
      Mail::to($userEmail->email)->send(new ResidentEmailNotification($update));

      $certificate->update();
      // dd($certificate);
      return response()->json([
        'status' => 200,
        'success' => true,
        'message' => 'Your request is upated!',
        'certificate' => $certificate,
        'update' => $update
      ]);
    }
    public function deleteCertificate(Request $request, $id){
      $certificate = Certificate::find($id);
      $certificate->delete();
      // dd($typeofrequest);
        return response()->json([
          "success" => "Request deleted successfully.",
          "data" => $certificate,
          "status" => 200
      ]);
    }
    public function viewall(){
      $incartcertificateRequests = DB::table('certificates')
        ->select('certificates.name')->where('status', 'in cart')
        ->count();
        $pendingcertificateRequests = DB::table('certificates')
        ->select('certificates.name')->where('status', 'pending')
        ->count();
        $donecertificateRequests = DB::table('certificates')
        ->select('certificates.name')->where('status', 'received')
        ->count();
        return View::make('certificate.viewall', compact('incartcertificateRequests', 'pendingcertificateRequests', 'donecertificateRequests'));
    }
    public function getAllCertificates(Request $request){
        if ($request->ajax()) {
            $certificates = Certificate::orderBy('id', 'DESC')->get();
            
            return response()->json($certificates);
        }
    }
    public function pending(){
      return view('certificate.pending');
    }
    public function getPendingCertificates(Request $request){
        if ($request->ajax()) {
            $pending = DB::table('certificates')
            ->where('status', 'pending')
            ->get();
            
            return response()->json($pending);
        }
    }
}
