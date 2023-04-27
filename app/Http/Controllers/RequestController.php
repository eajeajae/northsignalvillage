<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requestdocument;
use DB;

class RequestController extends Controller
{
    public function index(){
        return view('admin.requests');
    }
    public function getAllRequests(Request $request){
        if ($request->ajax()) {
            // $requestdocuments = Requestdocument::where('status', 'to process')->orderBy('id', 'DESC')->get();
            $requestdocuments = DB::table('requestdocuments')
            ->leftjoin('mods', 'mods.id', '=', 'requestdocuments.mod_id')
            ->select('requestdocuments.requestId AS requestId', 'requestdocuments.typeofdoc AS typeofdoc', 'requestdocuments.price AS price', 'mods.modeofdelivery AS modeofdelivery', 'requestdocuments.modeofpayment AS modeofpayment')
            ->get();
            return response()->json($requestdocuments);
        }
    }
}
