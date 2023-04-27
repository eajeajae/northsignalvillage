<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Joboffer;
use App\Models\Employer;
use Auth;
use View;

class JobofferController extends Controller
{
    public function index(){
        $employer = Employer::pluck('companyName', 'id');
        return View::make('job.index', compact('employer')); 
    }
    
    public function getAllJoboffers(Request $request){
        if ($request->ajax()) {
            $joboffers = Joboffer::orderBy('id', 'asc')->get();
            return response()->json($joboffers);
        }
    }

    public function storeJoboffer(Request $request){

        $joboffer = new Joboffer;
        $joboffer->job = $request->job;
        $joboffer->jobDesc = $request->jobDesc;
        $joboffer->employer_id = $request->employer_id;

        $joboffer->save();
        $joboffer->user;
        return response()->json([
            'status' => 200,
            'success' => true, 
            'message' => 'You successfully added a job!',
            'joboffer' => $joboffer
        ]);
    }

    public function update(Request $request){
        $joboffer = Joboffer::find($request->id);

        $joboffer->job = $request->job;
        $joboffer->jobDesc = $request->jobDesc;
        $joboffer->employer_id = $request->employer_id;
        $joboffer->update();

        return response()->json([
            'success' => true, 
            'message' => 'Job is updated.'
        ]);
    }
    
}
