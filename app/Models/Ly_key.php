<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ly_key extends Model
{
    use HasFactory;
    protected $table = 'ly_assignations';
   

    public function storeModel($request){  
          
	    foreach($request->data as $row) {
            $parameters=array('id_emp' => $row['empid'],
            'weekdays' => $row['days'],   
            'shared' =>  $row['shared']
          );


                $shared = Ly_assignation::where('seatName',$row['spot'])
                                      ->where('shift',$row['shift'])
                                      ->select('ly_assignations.shared')
                                      ->get(); 

        
                if ($row['shared']==true&&$shared[0]['shared']==false){
                    $params=array('id_emp' => 0,
                              'weekdays' => 'Mo,Tu,We,Th,Fr',   
                              'shared' =>  $row['shared']
                            );

                    Ly_assignation::where('seatName',$row['spot'])
                    ->where(function($query) use($row)
                    {  
                        $query->orWhere('shift', '=', '1')
                                ->orWhere('shift', '=', '2')
                                ->orWhere('shift', '=', '3')
                                ->orWhere('shift', '=', '4');
                        
                    })     
                    ->update($params);     

                }
            

                Ly_assignation::where('seatName',$row['spot'])
                                ->where(function($query) use($row)
                                {  
                                    if($row['shared']==false){
                                    $query->orWhere('shift', '=', '1')
                                            ->orWhere('shift', '=', '2')
                                            ->orWhere('shift', '=', '3')
                                            ->orWhere('shift', '=', '4');
                                    }else{
                                        $query->where('shift',$row['shift']);
                                    }
                                })     
                                ->update($parameters);     
                }
                                   
        
        // return  $data;
    }

}
