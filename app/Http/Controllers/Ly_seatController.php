<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ly_seat;

class Ly_seatController extends Controller
{
    public function index(){
        return view('layout.setting');
    }
    
    public function show(){
        $productos=Ly_seat::get();   
        dd($productos);
        return $productos;
    }
    
    public function store(Request $request){    
        $seat= new Ly_seat;     
        return response()->json($seat->storeModel($request));
    }
}
