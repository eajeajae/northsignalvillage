<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Donation;
use App\Models\Otherdonation;
use App\Models\User;
use Auth;
use Storage;
use View;

class DonationController extends Controller
{
    public function index(Request $request){
        $id = Auth::id();
        $user = User::find($id);
        // return $request->donation();
        return View::make('donation.create', compact('user'));
    }

    public function create(Request $request){

        $donation = new Donation;
        $donation->user_id = Auth::user()->id;
        $donation->gcashName = $request->gcashName;
        $donation->gcashPhoneNum = $request->gcashPhoneNum;
        $donation->donorName = Auth::user()->name;
        $donation->amountDonated = $request->amountDonated;
        
        if($request->hasFile('receipt_img')){
            $file = $request->file('receipt_img');
            $extension = $file->getClientOriginalExtension();
            $receipt_img = time().'.'.$extension;
            $file->move('storage/donations/', $receipt_img);
            $donation->receipt_img = $receipt_img;
        }

        $donation->save();
        // dd($donation);
        $data=array('status' => 'saved');

        return response()->json([
            'status' => 200
        ]);
    }
    public function showCashdonation($id){
      $cashdonation = Donation::find($id);

      if ($cashdonation) {
          return response()->json([
              'cashdonation'=> $cashdonation
          ]);
      }
      else{
          return response()->json([
              'status'=>404,
              'message'=>'Donation data not found',
          ]);
      }  
    }
    public function update(Request $request){
        $donation = Donation::find($request->id);

        if(Auth::user()->id != $request->id){
            return response()->json([
                'success' => false, 
                'message' => 'Authorized Users Only.'
            ]);
        }
        $donation->gcashName = $request->gcashName;
        $donation->gcashPhoneNum = $request->gcashPhoneNum;
        $donation->donorName = $request->donorName;
        $donation->receipt_img = $request->receipt_img;
        
        $donation->update();

        return response()->json([
            'success' => true, 
            'message' => 'Donation is updated.'
        ]);
    }
    public function delete($id){
        $cashdonation = Donation::findOrFail($id);

        if($cashdonation->receipt_img != ''){
            Storage::delete('storage/donations'.$cashdonation->receipt_img);
        }

        $cashdonation->delete();

        return response()->json([
          'status' => 200,
          'success' => true, 
          'message' => 'You deleted your donation.'
        ]);
    }
    public function deleteOtherdonation($id)
    {
        $otherdonation = Otherdonation::findOrFail($id);
        $otherdonation->delete();
        return response()->json([
            "success" => "Donation deleted successfully.",
            "otherdonation" => $otherdonation,
            "status" => 200
        ]);
    }
    public function getAllCashdonations(Request $request){
      if ($request->ajax()) {
          $cashdonations = Donation::orderBy('id', 'asc')->get();
          
          return response()->json( $cashdonations);
      }
    }
    public function storeOtherdonation(Request $request){
      $otherdonation = new Otherdonation;
      $otherdonation->category = $request->category;
      $otherdonation->items = $request->items;
      $otherdonation->quantity = $request->quantity;

      $otherdonation->save();
      $data=array('status' => 'saved');

      return response()->json([
          'status' => 200
      ]);
    }
    public function editOtherdonation($id){
      $otherdonation = Otherdonation::find($id);

      if ($otherdonation) {
          return response()->json([
              'otherdonation'=> $otherdonation
          ]);
      }
      else{
          return response()->json([
              'status'=>404,
              'message'=>'Donation data not found',
          ]);
      }  
    }
    public function updateOtherdonation(Request $request, $id){
      $otherdonation = Otherdonation::find($id);
      $otherdonation->category = $request->category;
      $otherdonation->items = $request->items;
      $otherdonation->quantity = $request->quantity;
      $otherdonation->update();

      return response()->json([
          'status' => 200
      ]);
    }
    public function getAllOtherdonations(Request $request){
      if ($request->ajax()) {
        $otherdonations = Otherdonation::orderBy('id', 'asc')->get();
        
        return response()->json( $otherdonations);
      }
    }

    public function viewall(){
        return view('donation.viewall');
    }
}
