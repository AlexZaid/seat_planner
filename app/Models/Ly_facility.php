<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
                                    ORDER BY `seatName` DESC"));

        return $spots;
    }


    public function changes(){
        $changes =DB::select(DB::raw("SELECT 
        oldLayout.seatName as oldSeat,
        oldLayout.shift as oldShift,
        oldLayout.shared as oldShared, 
        subquery.newSeat,
        subquery.newShift,
        subquery.newShared,
        CONCAT(actualKey.seatKeys,'  ',actualKey.seatName,'/',actualKey.shift) AS oldKeys,
        CONCAT(subquery.newKeys,'  ', subquery.newSeat,'/', subquery.newShift) AS newKeys,
        subquery.newIdemp,
        subquery.newEmpName 
    FROM (SELECT 
                    live.seatName AS newSeat,
                    live.shift as newShift,
                    live.shared as newShared,
                    live.seatKeys AS newKeys,
                    live.id_emp as newIdemp,
                    CONCAT(eNew.first_name,' ',eNew.last_name) AS newEmpName,
                    old.id_emp as oldIdemp,
                    CONCAT(eOld.first_name,' ',eOld.last_name) AS oldEmpName
            FROM ly_assignations AS live
            INNER JOIN ly_assignations_comparison AS old ON live.seatName = old.seatName AND live.shift = old.shift 
            LEFT JOIN employee AS eNew ON live.id_emp=eNew.id_emp
            LEFT JOIN employee AS eOld ON old.id_emp=eOld.id_emp
                WHERE live.id_emp != old.id_emp  
            ) AS subquery
    LEFT JOIN employee AS empNew on empNew.id_emp=subquery.newIdemp
    LEFT JOIN ly_assignations_comparison AS oldLayout on empNew.id_emp=oldLayout.id_emp
    LEFT JOIN ly_key_loans as actualKey on empNew.id_emp=actualKey.id_emp
         ORDER BY oldSeat ASC"));

        return $changes;
    }
}
