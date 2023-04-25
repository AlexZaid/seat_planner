<?php

namespace App\Http\Controllers;

use App\Models\Ly_spot;
use Illuminate\Http\Request;

class Ly_spotController extends Controller
{
    public function index(){
        return view('layout.office');
    }
    public function spots(Request $request,$floor){
        $ly_spot=new Ly_spot();
        $ly_spots=$ly_spot->getSpots($floor);   
        return view('layout.spot',['ly_spots'=>$ly_spots]);
    }

    public function unassigned_employees(){
        $ly_spot=new Ly_spot();
        $ly_employee=$ly_spot->getUnassignedEmployees();   
        return view('layout.employee',['ly_employee'=>$ly_employee]);
    }
}