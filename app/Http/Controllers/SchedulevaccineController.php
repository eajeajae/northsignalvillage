<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VaccinationScheduleNotification;
use App\Models\User;
use App\Models\Schedulevaccine;
use App\Models\Vaccine;
use Auth;
use View;
use DB;
class SchedulevaccineController extends Controller
{
    public function index(){
        $id = Auth::id();
        $user = User::find($id);
        $vaccine = Vaccine::pluck('name', 'id');
        // dd($vaccine);
        return View::make('schedulevaccine.create', compact('user', 'vaccine'));
    }

    public function store(Request $request){
        $schedulevaccine = new Schedulevaccine;
        $vaccineName = Vaccine::find($request->vaccine_id);
        $schedulevaccine->user_id = Auth::user()->id;
        $schedulevaccine->name = Auth::user()->name;
        $schedulevaccine->contact_num = Auth::user()->phoneNum;
        $schedulevaccine->vaccine_id = $request->vaccine_id;
        $schedulevaccine->vaccineName = $vaccineName->name;
        $schedulevaccine->date = $request->date;
        $schedulevaccine->time = $request->time;
        $schedulevaccine->addressNo = Auth::user()->addressNo;
        $schedulevaccine->street = Auth::user()->street;
        $schedulevaccine->email = Auth::user()->email;
        // dd($schedulevaccine);
        $schedulevaccine->save();
        
        return response()->json([
            'status' => 200,
            'success' => true, 
            'message' => 'Thank you! Your application is submitted successfuly.',
            'schedulevaccine' => $schedulevaccine
        ]);
    }
    public function show($id){
      $schedulevaccine = Schedulevaccine::find($id);
      if ($schedulevaccine) {
          return response()->json([
              'schedulevaccine'=> $schedulevaccine,
          ]);
      }
      else{
          return response()->json([
              'status'=>404,
              'message'=>'Vaccination Schedule data not found',
          ]);
      }
  }
    public function edit($id){
        $schedulevaccine = Schedulevaccine::find($id);
        if ($schedulevaccine) {
            return response()->json([
                'schedulevaccine'=> $schedulevaccine,
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Vaccination Schedule data not found',
            ]);
        }
    }
    //update vaccination schedule (for resident) //eedit pa 
    public function update(Request $request, $id){
      $schedulevaccine = Schedulevaccine::find($id);
      $schedulevaccine->status = $request->status;
      $schedulevaccine->update();

      return response()->json([
        'status' => 200,
        'success' => true, 
        'schedulevaccine' => $schedulevaccine
      ]);
    }
    //update vaccination schedule (for admin)
    public function updateVaccinationSchedule(Request $request, $id){
      $schedulevaccine = Schedulevaccine::find($id);
      $schedulevaccine->status = $request->status;
      $userEmail = User::find($request->user_id);

      $update = [
        'name' => $userEmail->name,
        'date' => $request->date,
        'time' => $request->time,
        'vaccineName' => $request->vaccineName,
        'status' => $request->status
      ]; 
      Mail::to($userEmail->email)->send(new VaccinationScheduleNotification($update));


      $schedulevaccine->update();

      return response()->json([
        'status' => 200,
        'success' => true, 
        'schedulevaccine' => $schedulevaccine
      ]);
    }
    public function viewall(){
        $vaccines = DB::table('vaccines')
        ->select('vaccines.name')
        ->count();
        $waitinglist = DB::table('schedulevaccines')
        ->select('schedulevaccines.name')->where('status', 'waiting list')
        ->count();
        $residentScheduled = DB::table('schedulevaccines')
        ->select('schedulevaccines.name')
        ->count();
        // $user = Schedulevaccine::find($id);
        return View::make('schedulevaccine.viewall', compact('vaccines', 'waitinglist', 'residentScheduled'));
    }
    public function getAllSchedulevaccine(Request $request){
        // if ($request->ajax()) {
            $schedulevaccine = DB::table('schedulevaccines')
            ->select('id','name AS title', 'date AS start')
            ->get();
            
            return response()->json($schedulevaccine);
        // }
    }
    public function waitinglist(){
        return view('schedulevaccine.waitinglist');
    }
    public function getWaitinglistSchedulevaccine(Request $request){
        // if ($request->ajax()) {
            $waitinglist = DB::table('schedulevaccines')
            ->select('id','name AS title', 'date AS start')
            ->where('status', 'waiting list')
            ->get();
            
            return response()->json($waitinglist);
        // }
    }

}
