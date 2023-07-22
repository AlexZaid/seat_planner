<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ly_keyLoan extends Model
{
    use HasFactory;
    public function showModel(){

        $keyLoans = DB::select(DB::raw("SELECT  c.oldSeat,
                                                c.oldShift,
                                                CONCAT(actualkey.seatKeys,' ',actualkey.seatName,'-',actualkey.shift) AS oldKeys,
                                                c.newSeat,
                                                c.newShift,
                                                CONCAT(assignation.seatKeys,' ',c.newSeat,'-',c.newShift) as newKeys,
                                                assignation.seatKeys as newSeatKey,
                                                emp.id_emp,
                                                concat(emp.first_name,' ',emp.last_name) as empName,
                                                actualkey.keyReturned
                                        FROM `ly_changes` as c
                                            Inner join employee as emp on emp.id_emp=c.id_emp
                                            inner join ly_assignations as assignation on assignation.seatName=c.newSeat and assignation.shift=c.newShift
                                            inner join ly_key_loans as actualkey on actualkey.id_emp=emp.id_emp
                                         WHERE (c.id) IN 
                                         ( SELECT MAX(c.id) FROM `ly_changes` as c
                                                Inner join employee as emp on emp.id_emp=c.id_emp
                                                inner join ly_assignations as assignation on assignation.seatName=c.newSeat and assignation.shift=c.newShift
                                                inner join ly_key_loans as actualkey on actualkey.id_emp=emp.id_emp
                                            where actualkey.keyReturned=false
                                                GROUP by emp.id_emp
                                         )"));

        return $keyLoans;
    }

    public function storeModel($request){  
	    foreach($request->data as $row) {
            $parameters=array(  'seatKeys' => ($row['newKeyCheck']==true) ? $row['newKey'] : '' ,
                                'seatName' => $row['spot'],
                                'shift' => $row['shift'],
                                'keyReturned' => $row['unlocked']);

            Ly_keyLoan::where('id_emp',$row['empid'])
                      ->update($parameters);     
        }      
        // return  $data;
    }
}
