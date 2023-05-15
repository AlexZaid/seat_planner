<?php

namespace App\Http\Controllers;
use App\Models\Ly_employee;
use Illuminate\Http\Request;

class Ly_employeeController extends Controller
{
    public function unassigned_employees(){
        $ly_employee=new Ly_employee();
        return view('layout.management.assignation.unassigned_employee',['ly_employee'=>$ly_employee->getUnassignedEmployees()]);
    } 
    
    public function assigned_employees(){
        $ly_employee=new Ly_employee();
        return view('layout.management.assignation.assigned_employee',['ly_employee'=>$ly_employee->getAssignedEmployees()]);
    }
}
