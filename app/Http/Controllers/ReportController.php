<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangayid;
use App\Models\Certificate;
use App\Models\Clearance;
use App\Models\Complaint;
use App\Models\Donation;
use App\Models\Otherdonation;
use App\Models\Schedulevaccine;
use DB;
use View;

class ReportController extends Controller
{
    public function viewBrgyidReport(){
        $barangayIdData = DB::table('barangayids')
        ->select('street', DB::raw("COUNT(street) as count"))
        ->groupBy('street')
        ->orderBy('count')
        ->get();
        // dd($barangayIdData);
        return view('report.barangayId', [
            'barangayIdData' => $barangayIdData,
        ]);
    }
    public function getBarangayidReport(Request $request){
        if ($request->ajax()) {
            $barangayid = Barangayid::select('street AS street', DB::raw("COUNT(street) AS count"))
            ->groupBy('street')
            ->orderBy('count', 'ASC')->limit(10)
            ->get();
            
            return response()->json($barangayid);
        }
    }
    public function viewCertificateReport(){
        $certificateData = DB::table('certificates')
        ->select('street AS street', DB::raw("COUNT(street) as count"))
        ->groupBy('street')
        ->orderBy('count', 'DESC')
        ->get();
        // dd($certificateDocuData);
        return view('report.certificate', [
            'certificateData' => $certificateData,
        ]);
    }
    public function getCertificateReport(Request $request){
        if ($request->ajax()) {
            $certificate = Certificate::select('street AS street', DB::raw("COUNT(street) AS count"))
            ->groupBy('street')
            ->orderBy('count', 'ASC')->limit(10)
            ->get();
            
            return response()->json($certificate);
        }
    }
    public function viewClearanceReport(){
        $clearanceData = DB::table('clearances')
        ->select('street AS street', DB::raw("COUNT(street) as count"))
        ->groupBy('street')
        ->orderBy('count', 'DESC')
        ->get();
        // dd($clearanceData);
        return view('report.clearance', [
            'clearanceData' => $clearanceData,
        ]);
    }
    public function getClearanceReport(Request $request){
        if ($request->ajax()) {
            $clearance = Clearance::select('street AS street', DB::raw("COUNT(street) AS count"))
            ->groupBy('street')
            ->orderBy('count', 'DESC')->limit(10)
            ->get();
            
            return response()->json($clearance);
        }
    }
    public function viewComplaintReport(){
        $complaintData = DB::table('complaints')
        ->select('locationStreet AS street', DB::raw("COUNT(locationStreet) as count"))
        ->groupBy('street')
        ->orderBy('count', 'DESC')
        ->get();
        // dd($complaintData);
        return view('report.complaint', [
            'complaintData' => $complaintData,
        ]);
    }
    public function getComplaintReport(Request $request){
        if ($request->ajax()) {
            $complaint = Complaint::select('complaintDesc as complaint', 'locationStreet AS street', DB::raw("COUNT(locationStreet) AS count"))
            ->groupBy('street', 'complaint')
            ->orderBy('count', 'DESC')->limit(10)
            ->get();
            
            return response()->json($complaint);
        }
    }
    public function viewVaccinationScheduleReport(){
        $scheduleVaccinationData = DB::table('schedulevaccines')
        ->select('street AS street', DB::raw("COUNT(street) as count"))
        ->groupBy('street')
        ->orderBy('count', 'DESC')
        ->get();
        // dd($scheduleVaccinationData);
        return view('report.scheduleVaccination', [
            'scheduleVaccinationData' => $scheduleVaccinationData,
        ]);
    }
    public function getVaccinationScheduleReport(Request $request){
        if ($request->ajax()) {
            $scheduleVaccine = DB::table('schedulevaccines')
            ->select('street AS street', DB::raw("COUNT(street) as count"))
            ->groupBy('street')
            ->orderBy('count', 'DESC')
            ->get();
            
            return response()->json($scheduleVaccine);
        }
    }
  public function viewDonationReport(){
    $otherdonationData = DB::table('otherdonations')
    ->select('items AS items', DB::raw("CAST(SUM(quantity) AS INTEGER) AS sum"))
    ->groupBy('items')
    ->orderBy('sum', 'DESC')
    ->get();
    // dd($otherdonationData);
    return View::make('report.donation', compact('otherdonationData'));
  }
  public function getOtherdonationReport(Request $request){
      if ($request->ajax()) {
          $otherdonation = DB::table('otherdonations')
          ->select('items AS item', DB::raw("SUM(quantity) as sum"))
          ->groupBy('item')
          ->orderBy('sum')
          ->get();
          
          return response()->json($otherdonation);
      }
  }
}
