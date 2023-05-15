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
}
