<?php

namespace App\Http\Controllers;
use App\Models\Ly_key;
use Illuminate\Http\Request;

class Ly_keyController extends Controller
{
    public function index(){
        return view('summary.facility.keys',['keys'=>Ly_key::all()]);
    }  
    
    public function store(){
        // return view('summary.facility.keys',['keys'=>Ly_key::all()]);
    }  
}
