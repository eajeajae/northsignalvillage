<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use App\Models\Clearance;
use App\Models\Certificate;
use App\FPDF\wordwrap;

class GenerateController extends Controller
{
  public function previewClearance($id){
    $clearanceRequest = Clearance::Find($id);
      if ($clearanceRequest) {
        return response()->json([
          'status' => 200,
          'clearanceRequest'=> $clearanceRequest,
        ]);
      }
      else{
          return response()->json([
              'status'=>404,
              'message'=>'Clearance form not found',
          ]);
      }
  }
    public function processClearance(Request $request){
      $name = $request->name;
      $address = $request->address;
      $typeofdoc = $request->typeofdoc;
      $date = \Carbon\Carbon::parse($request->created_at)->format('d/m/Y');;
      $controlno = $request->control_no;
      
      $outputfile = public_path().'clearance.pdf';
      $this->generateClearance(public_path().'/generate/clearance.pdf',$outputfile,$name,$address,$typeofdoc,$date,$controlno);

      return response()->file($outputfile);
    }
    public function generateClearance($file,$outputfile,$name,$address,$typeofdoc,$date,$controlno){

      $fpdi = new FPDI;
      $fpdi->setSourceFile($file);
      $template = $fpdi->importPage(1);
      $size = $fpdi->getTemplateSize($template);
      $fpdi->AddPage($size['orientation'],array($size['width'],$size['height']));
      $fpdi->useTemplate($template);
      
      //Printing the name    
      $fpdi->SetTextColor(0,0,0);  
      $fpdi->SetFont('helvetica','');
      $fpdi->Cell(200,182,"                                                            $name",0,0,'C');

      $fpdi->Ln(4);

      //Printing the address
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('helvetica','');
      $fpdi->Cell(0,186,"              $address",0,0,'C');
      
      $fpdi->Ln(2);

      //Printing the typeofdoc
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('helvetica','');
      $fpdi->Cell(0,214,"                          $typeofdoc",0,0,'C');
      $fpdi->Ln(2);

      //Printing the date
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('helvetica','');
      $fpdi->Cell(0,229,"                     $date",0,0,'C');
      $fpdi->Ln(4);

      //Printing the control_no
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('helvetica','');
      $fpdi->SetXY(65,154); //sets the position for the name;
      $fpdi->Cell(30,50,"   $controlno",0,0,'C');

      // $fpdi->Text($rightforname,$topforname,$pangalan);
      return $fpdi->Output($outputfile, 'F');
    }

    //certificate requests
    public function previewCertificate($id){
      $certificateRequest = Certificate::Find($id);
        if ($certificateRequest) {
          return response()->json([
            'status' => 200,
            'certificateRequest'=> $certificateRequest,
          ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Certificate form not found',
            ]);
        }
    }
    public function processCertificate(Request $request){
      $name = $request->name;
      $address = $request->address;
      $typeofdoc = $request->typeofdoc;
      $date = \Carbon\Carbon::parse($request->created_at)->format('d/m/Y');;
      $controlno = $request->control_no;
      $requestof = $request->requestof;
      $statedescription = $request->complainantPrayer;
      
      $outputfile = public_path().'certificate.pdf';
      $this->generateCertificate(public_path().'/generate/certificate.pdf',$outputfile,$name,$address,$typeofdoc,$date,$controlno,$requestof,$statedescription);

      return response()->file($outputfile);
    }
    public function generateCertificate($file,$outputfile,$name,$address,$typeofdoc,$date,$controlno,$requestof,$statedescription){

      $fpdi = new FPDI;
      $fpdi->setSourceFile($file);
      $template = $fpdi->importPage(1);
      $size = $fpdi->getTemplateSize($template);
      $fpdi->AddPage($size['orientation'],array($size['width'],$size['height']));
      $fpdi->useTemplate($template);
      
      //Printing the name    
      $fpdi->SetTextColor(0,0,0);  
      $fpdi->SetFont('arial','B');
      $fpdi->SetXY(72,129); //sets the position for the name;
      $fpdi->Cell(10,0,"                                                            $name",0,0,'C');

      $fpdi->Ln(4);

      //Printing the address
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('arial','B');
      $fpdi->SetXY(70,142); //sets the position for the address;
      $fpdi->Cell(10,0,"$address",0,0,'C');
      
      $fpdi->Ln(2);
      
      //Printing the requestof
       $fpdi->SetTextColor(0,0,0);
       $fpdi->SetFont('arial','B');
       $fpdi->SetXY(137,179); //sets the position for the requestof;
       $fpdi->Cell(10,0,"$requestof",0,0,'L');
       $fpdi->Ln(2);

      //Printing the statedescription
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('arial','', 13);
      $fpdi->SetXY(50,147); //sets the position for the statedescription;
      $fpdi->MultiCell(144,6,"  $statedescription",0,'L');
      $fpdi->Ln(2);

      //Printing the typeofdoc
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('arial','B');
      $fpdi->SetXY(123,82); //sets the position for the typeofdoc;
      $fpdi->Cell(10,0,"Certificate of $typeofdoc",0,0,'C');
      $fpdi->Ln(2);

      //Printing the date
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('arial','B');
      $fpdi->SetXY(73,198); //sets the position for the date;
      $fpdi->Cell(10,0,"$date",0,0,'L');
      $fpdi->Ln(4);

      //Printing the control_no
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('arial','');
      $fpdi->SetXY(80,29); //sets the position for the control_no;
      $fpdi->Cell(30,50,"$controlno",0,0,'C');

      // $fpdi->Text($rightforname,$topforname,$pangalan);
      return $fpdi->Output($outputfile, 'F');
    }
    public function processSummon(Request $request){
      $forComplainantName = $request->forComplainantName;
      $complainantName = $request->complainantName;
      $respondentName = $request->respondentName;
      $summonTo = $request->toRespondents;
      $mediationDate = \Carbon\Carbon::parse($request->created_at)->format('d/m/Y');;
      $caseNo = $request->caseNo;
      $mediationSchedule = $request->mediationSchedule;
      $punongBarangay = $request->punongBarangay;
      
      $outputfile = public_path().'summoning-letter.pdf';
      $this->generateSummon(public_path().'/generate/summoning-letter.pdf',$outputfile,$complainantName,$respondentName,$summonTo,$mediationDate,$caseNo,$mediationSchedule,$forComplainantName,$punongBarangay);

      return response()->file($outputfile);
    }
    public function generateSummon($file,$outputfile,$complainantName,$respondentName,$summonTo,$mediationDate,$caseNo,$mediationSchedule,$forComplainantName,$punongBarangay){

      $fpdi = new FPDI;
      $fpdi->setSourceFile($file);
      $template = $fpdi->importPage(1);
      $size = $fpdi->getTemplateSize($template);
      $fpdi->AddPage($size['orientation'],array($size['width'],$size['height']));
      $fpdi->useTemplate($template);
      
      //Printing the forComplainantName    
      $fpdi->SetTextColor(0,0,0);  
      $fpdi->SetFont('Times','B');
      $fpdi->SetXY(127,80); //sets the position for the forComplainantName;
      $fpdi->Cell(10,0,"$forComplainantName",0,0,'L');

      $fpdi->Ln(4);

      //Printing the caseNo
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('Times','B');
      $fpdi->SetXY(145,72); //sets the position for the caseNo;
      $fpdi->Cell(10,0, "case",0,0,'L');
      
      $fpdi->Ln(2);
      //Printing the complainant Vs.    
      $fpdi->SetTextColor(0,0,0);  
      $fpdi->SetFont('Times','B');
      $fpdi->SetXY(55,71); //sets the position for the complainant Vs.;
      $fpdi->Cell(10,0,"$complainantName",0,0,'C');

      $fpdi->Ln(4);

      //Printing the Vs. respondentName    
      $fpdi->SetTextColor(0,0,0);  
      $fpdi->SetFont('Times','B');
      $fpdi->SetXY(55,105); //sets the position for the complainant Vs.;
      $fpdi->Cell(10,0,"$respondentName",0,0,'C');

      $fpdi->Ln(4);

      //Printing the summonTo
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('Times','B');
      $fpdi->SetXY(55,137); //sets the position for the summonTo;
      $fpdi->Cell(10,0,"$summonTo",0,0,'C');
      $fpdi->Ln(2);

      //Printing the mediationDate
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('Times','B');
      $fpdi->SetXY(34,203); //sets the position for the mediationDate;
      $fpdi->Cell(10,0,"$mediationDate",0,0,'L');
      $fpdi->Ln(4);

      //Printing the mediationSchedule
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('Times','B');
      $fpdi->SetXY(32,167); //sets the position for the mediationSchedule;
      $fpdi->Cell(10,0,"$mediationSchedule",0,0,'L');

      //Printing the punongBarangay
      $fpdi->SetTextColor(0,0,0);
      $fpdi->SetFont('Times','B');
      $fpdi->SetXY(170,222); //sets the position for the punongBarangay;
      $fpdi->Cell(10,0,"$punongBarangay ",0,0,'C');

      // $fpdi->Text($rightforname,$topforname,$pangalan);
      return $fpdi->Output($outputfile, 'F');
    }
    
}
