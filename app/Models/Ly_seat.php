<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ly_seat extends Model
{
    use HasFactory;

    public function storeModel($request)
    {
        $this->seatName=$request->seatName;
        $this->floor=$request->floor;
        $this->description=$request->description;
        $this->posLeft=$request->posLeft;
        $this->posTop=$request->posTop;
        if($this->save()){
            $response=array('status'=>200,'saved'=>'save');
        }else{
            $response=array('status'=>500,'error'=>'true');
        }
        return  $response;
    }
    
}
