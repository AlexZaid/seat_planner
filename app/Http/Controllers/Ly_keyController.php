<?php

namespace App\Http\Controllers;
use App\Models\Ly_key;
use Illuminate\Http\Request;

class Ly_keyController extends Controller
{
    public function index(){
        $Ly_key=new Ly_key();
        return view('summary.facility.keys',['keys'=>$Ly_key->showModel()]);
    }  
    
    public function store(Request $request){
        $Ly_key=new Ly_key();
        return response()->json($Ly_key->storeModel($request));
       
    }  
}
