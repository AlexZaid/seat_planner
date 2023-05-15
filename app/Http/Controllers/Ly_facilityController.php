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
}
