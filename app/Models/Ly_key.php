<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ly_key extends Model
{
    use HasFactory;
    protected $table = 'ly_assignations';
   
    public function showModel(){
        $keys=Ly_key::where('shift','=','1')
                ->orWhere('shift', '=', '2')
                ->orderBy('seatName', 'DESC')
                ->get();
        
        return $keys;
    }
    public function storeModel($request){  
          
	    foreach($request->data as $row) {
            $parameters=array('seatKeys' => $row['seatKey']);

            Ly_assignation::where('seatName',$row['spot'])
                            ->where(function($query) use($row)
                            {  
                                if($row['shift']=='1' || $row['shift']=='4'){
                                    $query->orWhere('shift', '=', '1')
                                            ->orWhere('shift', '=', '4');
                                }else{
                                    $query ->orWhere('shift', '=', '2')
                                            ->orWhere('shift', '=', '3');
                                }
                            })     
                            ->update($parameters);     
        }
                                        
        // return  $data;
    }

}
