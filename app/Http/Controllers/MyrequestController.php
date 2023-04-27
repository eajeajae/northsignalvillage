<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Typeofrequest;
use App\Models\Myrequest;
use App\Models\Barangayid;
use App\Models\Certificate;
use App\Models\Clearance;
use App\Models\Mod;
use App\Models\Gcashpayment;
use App\Models\Transactiondetail;
use View;
use Auth;
use DB;

class MyrequestController extends Controller
{
    public function view(Request $request){
      $id = Auth::id();
      $user = User::find($id);
			$barangayids = DB::table('barangayids')
			->where('status', 'in cart')
			->where('barangayids.user_id', Auth::id())->get();
      $certificaterequests = DB::table('certificates')
      ->leftjoin('typeofrequests', 'typeofrequests.id', '=', 'certificates.typeofrequest_id')
      ->select('certificates.id AS id', 'certificates.typeofdoc AS typeofdoc', 'certificates.price AS price', 'certificates.typeofrequest_id AS typeofrequest_id')
			->where('certificates.status', 'in cart')
			->where('certificates.user_id', Auth::id())->get();
      $clearancerequests = DB::table('clearances')
      ->leftjoin('typeofrequests', 'typeofrequests.id', '=', 'clearances.typeofrequest_id')
      ->select('clearances.id AS id', 'clearances.typeofdoc AS typeofdoc', 'clearances.price AS price')
			->where('clearances.status', 'in cart')
			->where('clearances.user_id', Auth::id())->get();
			$mod = Mod::Select('modeofdelivery', 'fee', 'id')->get();
				return view('resident.myrequest', [
          'user' => $user,
					'barangayids' => $barangayids,
          'certificaterequests' => $certificaterequests,
          'clearancerequests' => $clearancerequests,
					'mod' => $mod
				]);
    }
    public function viewMyrequest(Request $request){
        if ($request->ajax()) {
					$myrequests = DB::table('typeofrequests')
					->leftjoin('myrequests', 'myrequests.typeofrequest_id', '=', 'typeofrequests.id')
					->select('typeofrequests.typeofdoc', 'typeofrequests.price', 'typeofrequests.category', 'myrequests.user_id', 'myrequests.typeofrequest_id')
					->where('myrequests.user_id', Auth::id())->get();

          return response()->json($myrequests);
        }
				
        // dd($myrequests);
        // return View::make('resident.myrequest', compact('myrequests'));
    }
		public function submitPayment(Request $request){
      $mod_id = Mod::find($request->modeofdelivery_id);
      
      $transactiondetail = new Transactiondetail;
      $transactiondetail->transaction_id = 'transactionid-'.rand(1111,9999);
      $transactiondetail->modeofdelivery = $mod_id->modeofdelivery;
      $transactiondetail->modeofpayment = $request->modeofpayment;
      $transactiondetail->user_id = $request->user_id;
      $transactiondetail->total_amount = $request->total_amount + $mod_id->fee;
      // dd($transactiondetail);
      $transactiondetail->save();

      if($transactiondetail->modeofpayment == 'GCASH'){
        $gcashpayment = new Gcashpayment;
        $gcashpayment->transactiondetail_id = $transactiondetail->id;
        $gcashpayment->save();
      }

      $barangayid = Barangayid::where('id', $request->barangayid_id)->update(['status' => 'pending']);
      $certificate = Certificate::where('id', $request->certificate_id)->update(['status' => 'pending']);
      $clearance = Clearance::where('id', $request->clearance_id)->update(['status' => 'pending']);

      $transactiondetailId = Transactiondetail::find($transactiondetail->id);
			return response()->json([
        'transactiondetailId' => $transactiondetailId,
				'status' => 200,
				'success' => true, 
				'message' => 'Thank you! Your application is submitted successfuly.'
		  ]);
		}
    public function submitgcashPayment(Request $request){
      $transactiondetail_id = $request->transactiondetail_id;
      $gcashpayment = Gcashpayment::where('transactiondetail_id', '=', $transactiondetail_id)->first();
			$gcashpayment->gcashName = $request->gcashName;
			$gcashpayment->gcashNumber = $request->gcashNumber;
			$gcashpayment->transactionId = 'transaction-'.rand(1111,9999);
			if($request->hasFile('payment_img')){
        $file = $request->file('payment_img');
        $extension = $file->getClientOriginalExtension();
        $payment_img = time().'.'.$extension;
        file_put_contents('storage/transactions/'.$payment_img,base64_decode($request->payment_img));
        $gcashpayment->payment_img = $payment_img;
      }
      // dd($gcashpayment);
      $gcashpayment->update();
			return response()->json([
				'status' => 200,
				'success' => true, 
				'message' => 'Thank you! Your application is submitted successfuly.'
		  ]);
		}
}
