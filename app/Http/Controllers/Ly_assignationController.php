<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ly_assignation;

class Ly_assignationController extends Controller
{
    public function index(){
        return view('layout.office.index');
    }
    
    public function show(Request $request,$floor){
        $seats=new Ly_assignation();  
        return view('layout.office.show',['seats'=> $seats->show($floor)]);
    }
}
