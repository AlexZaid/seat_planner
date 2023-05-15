<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ly_employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    public function getUnassignedEmployees(){
        $employees = Ly_employee::whereNotExists(function($query)
                    {   
                        $query->from('ly_assignations')
                              ->whereRaw('ly_assignations.id_emp=employee.id_emp');
                    })
                    ->where('emp_status','=', 'active')
                    ->where(function($query)
                        {  
                            $query->orWhere('office', '=','Leon Office')
                                   ->orWhere('department', '=', '5756 / RECF MX Leon')
                                   ->orWhere('id_emp', '=', '34553');
                        })     
                    ->get();
        return $employees;
    }


    public function getAssignedEmployees(){
        $employees = Ly_employee::join('ly_assignations', 'ly_assignations.id_emp', '=', 'employee.id_emp')
                                ->select('ly_assignations.*', 'employee.*')
                                ->get(); 
        return $employees;
    }
}
