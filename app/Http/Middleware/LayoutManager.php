<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayoutManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){  
            $user = Auth::user();
            $LayoutManager =DB::select(DB::raw("SELECT count(*) as nReg FROM `ly_manager` where id_emp=".$user->employeenumber[0]));
           
            if($LayoutManager[0]->nReg>0){
                return $next($request);
            }else{
                return redirect()->back(); 
            }
        }
        return $next($request);
    }
}
