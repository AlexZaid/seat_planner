<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ly_keyLoan extends Model
{
    use HasFactory;
    public function showModel(){
        $keyLoans = Ly_keyLoan::where('keyReturned', '=', false)
                            ->join('employee','ly_key_loans.id_emp', '=', 'employee.id_emp')
                            ->leftJoin('ly_assignations', 'ly_key_loans.id_emp', '=', 'ly_assignations.id_emp')
                            ->select(['ly_key_loans.*',
                                     'ly_assignations.seatName AS newSeatName',
                                     'ly_assignations.shift AS newShift',
                                     'ly_assignations.seatKeys AS newSeatKeys',
                                     Ly_keyLoan::raw('CONCAT(employee.first_name," ",employee.last_name) AS empName')])
                            ->get(); 

        return $keyLoans;
    }

    public function storeModel($request){  
       
	    foreach($request->data as $row) {
            $parameters=array('keyReturned' => $row['unlocked']);

            Ly_keyLoan::where('seatName',$row['spot'])
                      ->where('id_emp',$row['empid'])
                      ->where('shift',$row['shift'])
                      ->update($parameters);     
        }      
        // return  $data;
    }
}
