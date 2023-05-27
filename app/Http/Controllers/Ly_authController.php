<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Ly_authController extends Controller
{
    public function authenticate(Request $request){
        $credentials = [
            'samaccountname' => $request->username,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();  
            $LayoutManager =DB::select(DB::raw("SELECT count(*) as nReg FROM `ly_manager` where id_emp=".$user->employeenumber[0]));
           
            if($LayoutManager[0]->nReg>0){
                $request->session()->regenerate();            
                $request->session()->put('LayoutManager', true);
                return redirect()->intended('layout/management/assignation');
            }
            $this->logout($request);       
        }
        return redirect()->back(); 
    }  
    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();    
        $request->session()->regenerate();
        $request->session()->regenerateToken();
        return redirect()->back(); 
    }   
}


