<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ly_facility extends Model
{
    use HasFactory;

    public function summary(){
        $spots =DB::select(DB::raw("SELECT a.seatName,a.shift,a.id_emp,a.weekdays,a.shared,CONCAT(e.first_name,' ',e.last_name ) as emp_name,k.seatKeys
        FROM `ly_assignations` as a 
        left join employee as e on e.id_emp=a.id_emp  
        INNER JOIN ly_keys as k on k.seatName=a.seatName and k.shift=a.shift
    where a.id_emp>0 Group by id_emp,shift 
    union ALL
    
    SELECT a.seatName,a.shift,a.id_emp,a.weekdays,a.shared,CONCAT(' Seat open') as emp_name,k.seatKeys
            FROM `ly_assignations` as a 
            INNER JOIN ly_keys as k on k.seatName=a.seatName and k.shift=a.shift
        where a.id_emp =0 Group by seatName,shift  
    ORDER BY seatName,shift  ASC"));

        return $spots;
    }


    public function changes(){
        $changes =DB::select(DB::raw("SELECT oldLayout.seatName as oldSeat,oldLayout.shift as oldShift,oldLayout.shared as oldShared, subquery.newSeat,subquery.newShift,subquery.newShared,oldLayout.seatKeys AS oldKeys  ,subquery.newKeys,subquery.newIdemp,subquery.newEmpName FROM (SELECT live.seatName AS newSeat,live.shift as newShift,live.shared as newShared,live.seatKeys AS newKeys,live.id_emp as newIdemp,CONCAT(eNew.first_name,' ',eNew.last_name) AS newEmpName,old.id_emp as oldIdemp,CONCAT(eOld.first_name,' ',eOld.last_name) AS oldEmpName
        FROM ly_assignations AS live
        INNER JOIN ly_assignations_comparison AS old ON live.seatName = old.seatName AND live.shift = old.shift 
        LEFT JOIN employee AS eNew ON live.id_emp=eNew.id_emp
        LEFT JOIN employee AS eOld ON old.id_emp=eOld.id_emp
        WHERE live.id_emp != old.id_emp  
        ORDER BY `live`.`seatName` ASC) AS subquery
        LEFT JOIN employee AS empNew on empNew.id_emp=subquery.newIdemp
        LEFT JOIN ly_assignations_comparison AS oldLayout on empNew.id_emp=oldLayout.id_emp
        "));

        return $changes;
    }
}
