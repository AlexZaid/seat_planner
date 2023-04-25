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
                    ->where('emp_status','=', 'active')
                    ->where('name', '=', 'John')
                    ->where('name', '=', 'John')
                    ->orWhere(function($query)
                    {
                        $query->where('votes', '>', 100)
                              ->where('title', '<>', 'Admin');
                    })
                    ->doesntHave('dismissedRequests')
                    ->whereRaw('id_spot like :floor')
                    ->leftJoin('employee', 'employee.id_emp', '=', 'ly_spot_assignation_live.id_emp')
                    ->select('ly_spot_assignation_live.*', 'employee.*')
                    ->get();
        return $employees;
    }
}
