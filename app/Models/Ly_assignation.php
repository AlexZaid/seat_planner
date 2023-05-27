<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ly_assignation extends Model
{
    use HasFactory;
    public function showModel($floor,$layoutManager){
        /* if($layoutManager==true){ */
            $spots = Ly_assignation::whereRaw('ly_assignations.seatName like :floor', ['floor' => $floor.'%'])
                                    ->leftJoin('employee', 'employee.id_emp', '=', 'ly_assignations.id_emp')
                                    ->join('ly_seats', 'ly_seats.seatName', '=', 'ly_assignations.seatName')
                                    ->select('ly_assignations.*','ly_seats.*', 'employee.*')
                                    ->get(); 
       /*  }
        else{

            $spots = DB::table('ly_assignations_comparison')
                        ->whereRaw('ly_assignations_comparison.seatName like :floor', ['floor' => $floor.'%'])
                        ->leftJoin('employee', 'employee.id_emp', '=', 'ly_assignations_comparison.id_emp')
                        ->join('ly_seats', 'ly_seats.seatName', '=', 'ly_assignations_comparison.seatName')
                        ->select('ly_assignations_comparison.*','ly_seats.*', 'employee.*')
                        ->get(); 
        } */
        
        return $spots;
    }

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

