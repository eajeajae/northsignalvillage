<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Typeofrequest;
use App\Models\Complaint;
use View;
use Redirect;
use Session;
use Auth;
use Response;
use DB;

class LandingpageController extends Controller
{
  //auth::check()
    public function index(){
      $complaintData = DB::table('complaints')
        ->select('complaintDesc AS complaint', 'locationStreet as street', DB::raw("COUNT(complaintDesc) as count"))
        ->groupBy('complaint', 'street')
        ->orderBy('count', 'DESC')
        ->get();
      $street = Complaint::select('locationStreet')->get();
      $complaintStreets = DB::table('Complaints')
        ->select('complaintDesc', 'locationStreet')
        ->whereIn('locationStreet',$street)
        ->orderBy('locationStreet')
        ->get();
      $requestdocuments = Typeofrequest::orderBy('id', 'DESC')->get();
        // dd($complaintDescData);
      $announcements = Announcement::orderBy('id', 'DESC')->paginate(5);
      return View::make('landingpage.index', compact('announcements', 'complaintData', 'complaintStreets', 'requestdocuments')); 
    }
  //guests
  public function guest(){
    $requestdocuments = Typeofrequest::orderBy('id', 'DESC')->get();
    
    // dd($complaintStreet);
    return View::make('landingpage.guest', compact('requestdocuments')); 
  }
  public function latestUpdate(){
    $complaintData = DB::table('complaints')
      ->select('complaintDesc AS complaint', 'locationStreet as street', DB::raw("COUNT(complaintDesc) as count"))
      ->groupBy('complaint', 'street')
      ->orderBy('count', 'DESC')
      ->get();
    $announcements = Announcement::orderBy('id', 'DESC')->paginate(5);
    $street = Complaint::select('locationStreet')->get();
    $complaintStreets = DB::table('Complaints')
    ->select('complaintDesc', 'locationStreet')
    ->whereIn('locationStreet',$street)
    ->get();
    // dd($complaint, $complaintCount);
    return view('announcement.index', ['complaintData'=>$complaintData, 'announcements'=>$announcements, 'complaintStreets'=>$complaintStreets]);
  }
    public function getAllAnnouncements(Request $request){
        if ($request->ajax()) {
            $announcements = Announcement::orderBy('id', 'ASC')->get();
            
            return response()->json($announcements);
        }
    }

    public function viewAboutus(){
        return view('aboutbrgy.index');
    }
}
