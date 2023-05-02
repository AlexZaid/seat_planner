<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ly_assignation extends Model
{
    use HasFactory;
    
    public function show($floor){
        $spots = Ly_assignation::whereRaw('ly_assignations.seatName like :floor', ['floor' => $floor.'%'])
                                ->leftJoin('employee', 'employee.id_emp', '=', 'ly_assignations.id_emp')
                                ->join('ly_seats', 'ly_seats.seatName', '=', 'ly_assignations.seatName')
                                ->select('ly_assignations.*','ly_seats.*', 'employee.*')
                                ->get(); 
        return $spots;
    }
}
