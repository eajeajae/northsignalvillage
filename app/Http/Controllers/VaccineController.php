<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccine;
use DB;

class VaccineController extends Controller
{
    public function viewall(){
        return view('vaccine.viewall');
    }
    public function getAllVaccine(Request $request){
        if ($request->ajax()) {
            $vaccines = Vaccine::orderBy('id', 'asc')->get();
            
            return response()->json($vaccines);
        }
    }
    public function store(Request $request){
        $vaccine = new Vaccine;
        $vaccine->name = $request->name;
        $vaccine->category = $request->category;
        $vaccine->stocks = $request->stocks;

        $vaccine->save();

        return response()->json([
            'status' => 200, 
            'success' => true,
            'vaccine' => $vaccine
        ]);
    }
    public function edit($id){
        $vaccine = Vaccine::find($id);

        if ($vaccine) {
            return response()->json([
                'vaccine'=> $vaccine
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Vaccine data not found',
            ]);
        }    
    }
    public function update(Request $request, $id){
        $vaccine = Vaccine::find($id);
        $vaccine->name = $request->name;
        $vaccine->category = $request->category;
        $vaccine->stocks = $request->stocks;
        $vaccine->update();

        return response()->json([
            'status' => 200,
            'success' => true, 
            'vaccine' => $vaccine
        ]);
    }
    public function delete($id)
    {
        $vaccine = Vaccine::findOrFail($id);
        $vaccine->delete();
        return response()->json([
            "success" => "Vaccine deleted successfully.",
            "vaccine" => $vaccine,
            "status" => 200
        ]);

    }
}
