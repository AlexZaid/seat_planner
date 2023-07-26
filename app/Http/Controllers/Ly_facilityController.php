<?php

namespace App\Http\Controllers;

use App\Models\Ly_facility;
use Illuminate\Http\Request;

class Ly_facilityController extends Controller
{
    public function index(){
        return view('summary.facility.index');
    }

    public function summary(){
        $Ly_facility=new Ly_facility();
        $summaries=$Ly_facility->summary();
        return view('summary.facility.summary',['summaries'=> $summaries]);
   
    } 
    
    public function changes(){
        $Ly_facility=new Ly_facility();
        $changes=$Ly_facility->changes();
        return view('summary.facility.changes',['changes'=> $changes]);
   
    }

    public function changesKeysPDF(){
        $Ly_facility=new Ly_facility();
        $pdf=$Ly_facility->generateKeysPDF();
        // date_default_timezone_set('America/Chihuahua');
        // $pdf->save("../utilityFiles/employeekeys".date("Y_m_d_H_i_s").".pdf");
        return $pdf->stream();

       /*  $Ly_facility=new Ly_facility();
        $changes=$Ly_facility->changes();
        return view('summary.facility.changesKeysPDF',['changes'=> $changes]); */        
    }
}
