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
            $request->session()->regenerate();
            return redirect()->intended('layout/management/assignation');
        }
        return view ('login');  
    }  
    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->flush();     
        $request->session()->regenerate();
        $request->session()->regenerateToken();
        return redirect()->back(); 
    }   
}


