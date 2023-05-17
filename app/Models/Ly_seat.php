<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ly_seat extends Model
{
    use HasFactory;

    public function showModel($floor){
        $spots = Ly_seat::whereRaw('seatName like :floor', ['floor' => $floor.'%'])
                                ->get(); 
        return $spots;
    }

    public function storeModel($request)
    {
        foreach($request->data as $row) {
            $parameters=array('posTop' => $row['posTop'],
            'posLeft' => $row['posLeft']
            );

                Ly_seat::where('seatName',$row['seatName'])   
                                ->update($parameters);     
                }   
    
      
            // $response=array('status'=>200,'saved'=>'save');
        
            // $response=array('status'=>500,'error'=>'true');
        
        // return  $response;
    }
    
}
