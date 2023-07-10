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
                    ->leftJoin('employee AS manager', 'manager.id_emp', '=', 'employee.booking_manager')
                    ->where('employee.emp_status','=', 'active')
                    ->where(function($query)
                        {  
                            $query->orWhere('employee.office', '=','Leon Office')
                                   ->orWhere('employee.department', '=', '5756 / RECF MX Leon')
                                   ->orWhere('employee.id_emp', '=', '34553');
                        })
                    ->select('employee.*',  Ly_assignation::raw('CONCAT(manager.first_name, \' \',manager.last_name) AS managerName'))     
                    ->get();
        return $employees;
    }


    public function getAssignedEmployees(){
        $adminEmp=Ly_employee::rightJoin('ly_assignations', 'ly_assignations.id_emp', '=', 'employee.id_emp')
                             ->where('ly_assignations.shared', '=', false)
                             ->groupBy('ly_assignations.id_emp','ly_assignations.seatName')
                             ->select('ly_assignations.*', 'employee.*');

        $employees = Ly_employee::rightJoin('ly_assignations', 'ly_assignations.id_emp', '=', 'employee.id_emp')
                                ->where('ly_assignations.shared', '=', true)
                                ->select('ly_assignations.*', 'employee.*')
                                ->union($adminEmp)
                                ->orderBy('seatName', 'DESC')
                                ->get(); 
        return $employees;
    }
}
