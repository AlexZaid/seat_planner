<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ly_spotController;
use App\Http\Controllers\Ly_seatController;
use App\Http\Controllers\Ly_assignationController;
use App\Http\Controllers\Ly_shiftController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

/* Layout */
Route::group(['prefix'=>'layout'],function(){
    Route::group(['prefix'=>'office'],function(){
        Route::get('/', [Ly_assignationController::class,'index']);
        Route::get('/seat/{floor}', [Ly_assignationController::class,'show']);
        Route::get('/unassignedEmployees', [Ly_assignationController::class,'unassigned_employees']);
    });
    Route::group(['prefix'=>'management'],function(){

       
    });
});
