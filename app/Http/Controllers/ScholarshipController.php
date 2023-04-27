<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScholarshipApplicationNotification;
use App\Mail\ScholarshipApplicationNotice;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Scholarship;
use App\Models\Comment;
use Auth;
use Storage;
use View;
use DB;

class ScholarshipController extends Controller
{
    public function index(){
        $id = Auth::id();
        $user = User::find($id);
        return View::make('scholarship.create', compact('user'));
    }
    public function create(Request $request){

        $scholarship = new Scholarship;
        $scholarship->user_id = Auth::user()->id;
        $scholarship->scholarFname = Auth::user()->name;
        $scholarship->scholarPhonenum = Auth::user()->phoneNum;
        $scholarship->scholarSchool = $request->scholarSchool;
        $scholarship->scholarCourse = $request->scholarCourse;
        $scholarship->scholarEmail = Auth::user()->email;
        if($request->hasFile('scholarCor_img')){
            $file = $request->file('scholarCor_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/scholarships/', $filename);
            $scholarship->scholarCor_img = $filename;
        }
        if($request->hasFile('scholarGrade_img')){
            $image = $request->file('scholarGrade_img');
            $extension = $image->getClientOriginalExtension();
            $imagename = time().'.'.$extension;
            $image->move('storage/scholarships/', $imagename);
            $scholarship->scholarGrade_img = $imagename;
        }

        $scholarship->save();
        $data=array('status' => 'saved');
        
        return response()->json([
            'status' => 200,
            'success' => true, 
            'message' => 'Thank you! Your application is submitted successfuly.',
            'scholarship' => $scholarship
        ]);
    }
    public function show($id){
      $scholarship = Scholarship::find($id);
      $comment = Comment::find($id);

      if ($scholarship) {
          return response()->json([
              'scholarship'=> $scholarship,
              'comment' => $comment
          ]);
      }
      else{
          return response()->json([
              'status'=>404,
              'message'=>'Scholarship Application data not found',
          ]);
      }
  }
    public function edit($id){
        $scholarship = Scholarship::find($id);
				$comment = Comment::find($id);

        if ($scholarship) {
            return response()->json([
                'scholarship'=> $scholarship,
								'comment' => $comment
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Scholarship Application data not found',
            ]);
        }
    }
    //update scholarship application (for resident)
    public function update(Request $request, $id){
        $scholarship = Scholarship::find($id);
        $scholarship->scholarFname = $request->scholarFname;
        $scholarship->scholarPhonenum = $request->scholarPhonenum;
        $scholarship->scholarSchool = $request->scholarSchool;
        $scholarship->scholarCourse = $request->scholarCourse;
        $scholarship->scholarEmail = $request->scholarEmail;
        if($request->hasFile('scholarCor_img')){
          $destinationCor = 'storage/scholarships/'.$scholarship->scholarCor_img;
          if(File::exists($destinationCor)){
            File::delete($destinationCor);
          }
          $file = $request->file('scholarCor_img');
          $extension = $file->getClientOriginalExtension();
          $filename = time().'.'.$extension;
          $file->move('storage/scholarships/', $filename);
          $scholarship->scholarCor_img = $filename;
        }
        if($request->hasFile('scholarGrade_img')){
          $destinationGrade = 'storage/scholarships/'.$scholarship->scholarGrade_img;
          if(File::exists($destinationGrade)){
            File::delete($destinationGrade);
          }
          $image = $request->file('scholarGrade_img');
          $extension = $image->getClientOriginalExtension();
          $imagename = time().'.'.$extension;
          $image->move('storage/scholarships/', $imagename);
          $scholarship->scholarGrade_img = $imagename;
        }

        $scholarship->update();
        
        return response()->json([
            'status' => 200,
            'success' => true, 
            'message' => 'Scholarship Application is updated successfully',
            'scholarship' => $scholarship
        ]);
    }
    //update scholarshipApplication (for admin)
    public function updateScholarshipApplication(Request $request, $id){
      $scholarship = Scholarship::find($id);
      $scholarship->status = $request->status;
      $userEmail = User::find($request->user_id);

      if ($request->status == 'granted') {
        $update = [
          'name' => $userEmail->name,
          'status' => $request->status
        ]; 
        Mail::to($userEmail->email)->send(new ScholarshipApplicationNotification($update));
  
        $scholarship->update();
      }
      else{
        $scholarship->update();
      }
      
        
        return response()->json([
            'status' => 200,
            'success' => true, 
            'message' => 'Scholarship Application is updated successfully',
            'scholarship' => $scholarship
        ]);
    }

    public function viewall(){
        $waitinglists = DB::table('scholarships')
        ->select('scholarships.name')->where('status', 'waiting for evaluation')
        ->count();
        $grantedapplicants = DB::table('scholarships')
        ->select('scholarships.name')->where('status', 'granted')
        ->count();
        $notgrantedapplicants = DB::table('scholarships')
        ->select('scholarships.name')->where('status', 'not granted')
        ->count();
        return View::make('scholarship.viewall', compact('waitinglists', 'grantedapplicants', 'notgrantedapplicants'));
    }

    public function getAllScholarships(Request $request){
        if ($request->ajax()) {
            $scholarships = Scholarship::where('status', 'waiting for evaluation')->orderBy('id', 'asc')->get();
            
            return response()->json($scholarships);
        }
    }
    public function viewGrantedApplicants(){
        return view('scholarship.grantedApplicant');
    }
    public function getGrantedScholarships(Request $request){
        if ($request->ajax()) {
            $scholarships = Scholarship::where('status', 'granted')->orderBy('id', 'asc')->get();
            
            return response()->json($scholarships);
        }
    }
    public function viewNotGrantedApplicants(){
        return view('scholarship.notGrantedApplicant');
    }
    public function getNotGrantedScholarships(Request $request){
        if ($request->ajax()) {
            $scholarships = Scholarship::where('status', 'not granted')->orderBy('id', 'asc')->get();
            
            return response()->json($scholarships);
        }
    }
    public function deleteScholarshipApplication($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        $scholarship->delete();
        return response()->json([
            "success" => "Scholarship Application deleted successfully.",
            "scholarship" => $scholarship,
            "status" => 200
        ]);

    }
		public function addComment(Request $request, $id){
			$scholarship = Scholarship::find($id);
			$comment = new Comment;
			$comment->id = $scholarship->id;
      $comment->user_id = $scholarship->user_id;
      $comment->comment = $request->comment;
      $comment->scholarship_id = $scholarship->id;
			$comment->save();

      $userEmail = User::find($comment->user_id);

      $update = [
        'name' => $userEmail->name,
        'comment' => $comment->comment
      ]; 
      Mail::to($userEmail->email)->send(new ScholarshipApplicationNotice($update));
      // dd($comment);
      return response()->json([
        'status' => 200,
        'success' => true, 
        'message' => 'Comment has been added',
        'comment' => $comment
      ]);
		}
}
