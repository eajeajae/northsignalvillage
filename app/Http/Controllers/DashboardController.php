<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Barangayid;
use App\Models\Certificate;
use App\Models\Clearance;
use App\Models\Complaint;
use App\Models\Donation;
use App\Models\Scholarship;
use App\Models\Requestdocument;
use Auth;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
      $residents = DB::table('users')
      ->select('users.name')
      ->count();
      $admins = DB::table('users')
      ->select('users.name')->where('role', '!=', 'resident')
      ->count();
      //Residents (Verified, not verified)
      $verifiedResidentsDataChart = $this->verifiedResidentsData();
      $notverifiedResidentsDataChart = $this->notverifiedResidentsData();
      //Requests (Certificate, Clearance, Barangay ID)
      $barangayidDataChart = $this->barangayidData();
      $certificatesDataChart = $this->certificatesData();
      $clearancesDataChart = $this->clearancesData();
      //Complaints
      $complaintDataChart = $this->complaintData();
      $street = Complaint::select('locationStreet')->get();
      $complaintStreetData = DB::table('complaints')
      ->select('complaintDesc AS complaint', 'locationStreet as street', DB::raw("COUNT(complaintDesc) as count"))
      ->groupBy('complaint', 'street')
      ->orderBy('count', 'DESC')
      ->get();
      $complaintDescData = DB::table('complaints')
      ->select('complaintDesc AS complaint', DB::raw("COUNT(complaintDesc) as count"))
      ->groupBy('complaint')
      ->orderBy('count', 'DESC')
      ->get();
      // dd($complaintDescData);
      //Scholarship Application (School and Course)
      $scholarSchools = Scholarship::select('scholarSchool', DB::raw("COUNT(id) as count"))
      ->groupBy('scholarSchool')
      ->get();
      $scholarCourses = Scholarship::select('scholarCourse', DB::raw("COUNT(id) as count"))
      ->groupBy('scholarCourse')
      ->get();
      //Donations (GCASH)
      $donation_total = Donation::select(DB::raw("SUM(amountDonated) AS totalDonated"))
      ->groupBy(DB::raw("month(created_at)"))
      ->pluck('totalDonated');
      $donation_permonth = Donation::select(DB::raw("MONTHNAME(created_at) AS permonth"))
      ->groupBy(DB::raw("MONTHNAME(created_at)"))
      ->pluck('permonth');
      $donation_totalAmount = DB::table('donations')
      ->select(DB::raw("SUM(amountDonated) AS totalDonation"))
      ->pluck('totalDonation');
      return view('admin.dashboard', [
        'residents' => $residents,
        'admins' => $admins, 
        'verifiedResidentsDataChart' => $verifiedResidentsDataChart, 
        'notverifiedResidentsDataChart' => $notverifiedResidentsDataChart, 
        'barangayidDataChart' => $barangayidDataChart,
        'certificatesDataChart' => $certificatesDataChart,
        'clearancesDataChart' => $clearancesDataChart,
        'complaintDescData' => $complaintDescData,
        'complaintDataChart' => $complaintDataChart,
        'complaintStreetData' => $complaintStreetData,
        'scholarSchools' => $scholarSchools,
        'scholarCourses' => $scholarCourses,
        'donation_total' => $donation_total, 
        'donation_permonth' => $donation_permonth,
        'donation_totalAmount' => $donation_totalAmount,
      ]);
    }
    public function verifiedResidentsData(){
        $residentVerified = User::VerifiedResidents()->orderBy('created_at')->whereYear('created_at','2023')->get()
         ->groupBy(function ($date) {
             return $date->created_at->month;
         })
         ->map(function ($group) {
             return $group->count();
         })
         ->union(array_fill(1, 12, 0))
         ->sortKeys()
         ->toArray();
        return (array_values($residentVerified));
    }
    public function notverifiedResidentsData(){
        $residentNotverified = User::NotverifiedResidents()->orderBy('created_at')->whereYear('created_at','2023')->get()
         ->groupBy(function ($date) {
             return $date->created_at->month;
         })
         ->map(function ($group) {
             return $group->count();
         })
         ->union(array_fill(1, 12, 0))
         ->sortKeys()
         ->toArray();
        return (array_values($residentNotverified));
    }
    public function barangayidData(){
      $barangayids = Barangayid::select('*')
      ->orderBy('created_at')->whereYear('created_at','2023')->get()
      ->groupBy(function ($date) {
          return $date->created_at->month;
      })
      ->map(function ($group) {
          return $group->count();
      })
      ->union(array_fill(1, 12, 0))
      ->sortKeys()
      ->toArray();
      return (array_values($barangayids));
  }
    public function certificatesData(){

        $certificates = Certificate::select('*')->orderBy('created_at')->whereYear('created_at','2023')->get()
        ->groupBy(function ($date) {
            return $date->created_at->month;
        })
        ->map(function ($group) {
            return $group->count();
        })
        ->union(array_fill(1, 12, 0))
        ->sortKeys()
        ->toArray();
        return (array_values($certificates));
    }
    public function clearancesData(){
        $clearances = Clearance::select('*')
        ->orderBy('created_at')->whereYear('created_at','2023')->get()
        ->groupBy(function ($date) {
            return $date->created_at->month;
        })
        ->map(function ($group) {
            return $group->count();
        })
        ->union(array_fill(1, 12, 0))
        ->sortKeys()
        ->toArray();
        return (array_values($clearances));
    }
    public function complaintData(){

      $complaints = Complaint::select('*')->orderBy('created_at')->whereYear('created_at','2023')->get()
      ->groupBy(function ($date) {
          return $date->created_at->month;
      })
      ->map(function ($group) {
          return $group->count();
      })
      ->union(array_fill(1, 12, 0))
      ->sortKeys()
      ->toArray();
      return (array_values($complaints));
  }
    public function getAllRequests(Request $request){
        if ($request->ajax()) {
            $requests = Requestdocument::orderBy('id', 'asc')
            ->get();
            
            return response()->json($requests);
        }
    }

}
