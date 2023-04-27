<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Joboffer;
use App\Models\Employer;
use App\Models\Applicant;
use Auth;
use View;
use Storage;

class ApplicantController extends Controller
{
    public function index(Request $request){
        $employers = DB::table('employers')
        ->leftJoin('joboffers', 'employers.id', 'joboffers.employer_id')
        ->select('employers.id', 'employers.company_img', 'employers.companyName', 'joboffers.job')->get();
        // return view('job.create');
        return view::make('job.create', compact('employers'));
    }

    public function viewJobdetails($id){
        $employer = Employer::find($id);
        $joboffer = Joboffer::find($id);
        return view::make('job.view', compact('employer', 'joboffer'));
    }
    public function view(Request $request, $id) {
        if ($request->ajax()) {
            $employer = Employer::find($id);
            $joboffer = Joboffer::find($id);
            return response()->json([
                'employer' => $employer,
                'joboffer' => $joboffer
            ]);
        }
        
        // return View::make('animal.info', compact('animal'));
    }

    public function storeApplicant(Request $request, $id){

        $applicant = new Applicant;
        $applicant->user_id = Auth::user()->id;
        $applicant->employer_id = $id;
        $applicant->joboffer_id = $id;
        $files = $request->file('resume_file');
        $applicant->resume_file = 'storage/applicants/'.$files->getClientOriginalName();

        // dd($applicant);
        $applicant->save();
        $data=array('status' => 'saved');
        Storage::put('public/applicants/'.$files->getClientOriginalName(),file_get_contents($files));

        return response()->json([
            'status' => 200,
            'success' => true, 
            'message' => 'You successfully added a job!',
            'applicant' => $applicant
        ]);
    }
    public function viewall(){
        $employers = DB::table('employers')
        ->select('employers.companyName')
        ->count();
        $joboffers = DB::table('joboffers')
        ->select('joboffers.job')
        ->count();
        $applicants = DB::table('applicants')
            ->leftJoin('users', 'applicants.user_id', 'users.id')
            ->leftjoin('joboffers', 'applicants.joboffer_id', 'joboffers.id')
            ->leftjoin('employers', 'applicants.employer_id', 'employers.id')
            ->select('applicants.id AS id', 'employers.companyName AS companyName','users.name AS name', 'users.email AS email', 'joboffers.job AS jobOffer', 'applicants.resume_file AS resume_file')->get();
        return View::make('applicant.viewall', compact('employers', 'joboffers', 'applicants'));
    }
    public function getAllApplicants(Request $request){
        if ($request->ajax()) {
            $applicants = DB::table('applicants')
            ->leftJoin('users', 'applicants.user_id', 'users.id')
            ->leftjoin('joboffers', 'applicants.joboffer_id', 'joboffers.id')
            ->leftjoin('employers', 'applicants.employer_id', 'employers.id')
            ->select('applicants.id AS id', 'employers.companyName AS companyName', 'joboffers.job AS job', 'users.name', 'applicants.resume_file AS resume_file')->get();
            return response()->json($applicants);
        }
    }
    public function downloadFile(Request $request, $resume_file){
        $applicant = Applicant::find($resume_file);
        if ($applicant) {
            return response()->json([
                'applicant'=> $applicant
            ])->download($applicant);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Application data not found',
            ]);
        }
        // return response()->download(public_path('assets/'.$resume_file));
    }
    public function edit($id){
        $applicant = Applicant::find($id);

        if ($applicant) {
            return response()->json([
                'applicant'=> $applicant
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Application data not found',
            ]);
        }
    }
    public function delete($id)
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();
        return response()->json([
            "success" => "Applicant deleted successfully.",
            "applicant" => $applicant,
            "status" => 200
        ]);

    }
}
