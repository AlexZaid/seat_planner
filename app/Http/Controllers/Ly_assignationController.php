<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ly_assignation;

class Ly_assignationController extends Controller
{
    public function index(){
        return view('layout.management.assignation.index');
    }
    
    public function show(Request $request,$floor){
        $seats=new Ly_assignation();  
        $layoutManager=$request->session()->has('LayoutManager');
        return view('layout.management.assignation.show',['seats'=> $seats->showModel($floor,$layoutManager)]);
    }

    public function store(Request $request){    
        $layout= new Ly_assignation;     
        return response()->json($layout->storeModel($request));
    }
}
