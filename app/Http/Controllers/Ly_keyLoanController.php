<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ly_keyLoan;

class Ly_keyLoanController extends Controller
{
    public function index(){
        dd(Ly_keyLoan::all());
        // return view('summary.facility.keys',['keys'=>Ly_key::all()]);
    }  
}
