<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ly_keyLoan;

class Ly_keyLoanController extends Controller
{
    public function index(){
        $Ly_keyLoan=new Ly_keyLoan();
        return view('summary.facility.keyloan',['keyloans'=>$Ly_keyLoan->showModel()]);
    }  

    public function store(Request $request){
        $Ly_keyLoan=new Ly_keyLoan();
        return response()->json($Ly_keyLoan->storeModel($request));
       
    }  
}
