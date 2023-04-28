<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ly_spot extends Model
{
    use HasFactory;

    public function getSpots($floor){
        $spots = DB::table('ly_spot_assignation_live')
                    ->whereRaw('id_spot like :floor', ['floor' => $floor.'%'])
                    ->leftJoin('employee', 'employee.id_emp', '=', 'ly_spot_assignation_live.id_emp')
                    ->select('ly_spot_assignation_live.*', 'employee.*')
                    ->get();
        return $spots;
    }

    public function getUnassignedEmployees(){
        $employees = DB::table('employee')
                    ->whereNotExists(function($query)
                    {   
                        $query->from('ly_spot_assignation_live')
                              ->whereRaw('ly_spot_assignation_live.id_emp=employee.id_emp');
                    })
                    ->where('emp_status','=', 'active')
                    ->where(function($query)
                        {  
                            $query->orWhere('office', '=','Leon Office')
                                   ->orWhere('department', '=', '5756 / RECF MX Leon')
                                   ->orWhere('id_emp', '=', '34553');
                        })     
                    // ->select('*')
                    ->get();
        return $employees;
    }
}
