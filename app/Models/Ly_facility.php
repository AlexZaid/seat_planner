<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDF;

class Ly_facility extends Model
{
    use HasFactory;

    public function summary(){  
        $spots =DB::select(DB::raw("SELECT 
                                            a.seatName,
                                            a.shift,
                                            keyloans.seatKeys as employeeKeys,
                                            a.weekdays,
                                            a.shared,
                                            e.id_emp,
                                            CONCAT(e.first_name,' ',e.last_name) as emp_name 
                                    FROM `ly_assignations` as a 
                                        LEFT JOIN employee as e on a.id_emp=e.id_emp  
                                        LEFT JOIN ly_key_loans as keyloans on keyloans.id_emp=e.id_emp  
                                        WHERE a.shared=true
                                    UNION ALL
                                    SELECT 
                                            a.seatName,
                                            a.shift,
                                            keyloans.seatKeys as employeeKeys,
                                            a.weekdays,
                                            a.shared,
                                            e.id_emp,
                                            CONCAT(e.first_name,' ',e.last_name) as empName 
                                    FROM `ly_assignations` as a
                                        LEFT JOIN employee as e on a.id_emp=e.id_emp  
                                        LEFT JOIN ly_key_loans as keyloans on keyloans.id_emp=e.id_emp  
                                        WHERE a.shared=false AND a.shift=1 
                                    ORDER BY `seatName` DESC ,shift"));

        return $spots;
    }

    public function changes(){
        $changes =DB::select(DB::raw("SELECT ch.*,
                                    CONCAT(actualKey.seatKeys,'  ',actualKey.seatName,'-',actualKey.shift) AS oldKeys,
                                    CONCAT(ch.newKeys,'  ', ch.newSeat,'-',ch.newShift) AS newKeys,
                                    CONCAT(emp.first_name,'  ',emp.last_name) AS empName
                                FROM `ly_changes` as ch 
                                    LEFT JOIN employee AS emp on emp.id_emp=ch.id_emp
                                    LEFT JOIN ly_key_loans as actualKey on emp.id_emp=actualKey.id_emp    
                                where DATE(ch.created_at)=(SELECT MAX(DATE(ch.created_at)) From ly_changes as ch)" 
                                ));
        return $changes;
    }

    public function generateKeysPDF(){
        $pdf = PDF::setOptions(['isRemoteEnabled'=>true,'isHtml5ParserEnabled' => true]); 
        $pdf = $pdf->loadView('summary.facility.changesKeysPDF',['changes'=> $this->changes()]);
        return $pdf;
    }
}
