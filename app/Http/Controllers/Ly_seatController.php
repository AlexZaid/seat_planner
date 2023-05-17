<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ly_seat;

class Ly_seatController extends Controller
{
    public function index(){
        return view('layout.management.seats.index');
    }
    
    public function show(Request $request,$floor){
        $seats=new Ly_seat();  
        return view('layout.management.seats.show',['seats'=> $seats->showModel($floor)]);
    }
    
    public function store(Request $request){    
        $seat= new Ly_seat;     
        return response()->json($seat->storeModel($request));
    }
}
