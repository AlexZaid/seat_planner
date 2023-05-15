<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ly_assignationController;
use App\Http\Controllers\Ly_seatController;
use App\Http\Controllers\Ly_employeeController;
use App\Http\Controllers\Ly_facilityController;
use App\Http\Controllers\Ly_keyController;

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
    // return redirect()->route('layout');
    return redirect('/layout/management/assignation');
});

/* Layout */
Route::group(['prefix'=>'layout'],function(){
    /* Route::group(['prefix'=>'office'],function(){
        Route::get('/', [Ly_assignationController::class,'index'])->name('layout');
        Route::get('/seat/{floor}', [Ly_assignationController::class,'show']);
        Route::get('/unassignedEmployees', [Ly_employeeController::class,'unassigned_employees']);
    });  */
    
    Route::group(['prefix'=>'management'],function(){
        Route::group(['prefix'=>'assignation'],function(){
            Route::get('/', [Ly_assignationController::class,'index']);
            Route::get('/seat/{floor}', [Ly_assignationController::class,'show']);
            Route::get('/unassignedEmployees', [Ly_employeeController::class,'unassigned_employees']);
            Route::get('/assignedEmployees', [Ly_employeeController::class,'assigned_employees']);
        });

        Route::group(['prefix'=>'editSeats'],function(){
            Route::get('/', [Ly_seatController::class,'index']);
        });
    });
});

/* Summary */
Route::group(['prefix'=>'summary'],function(){
    Route::group(['prefix'=>'facilities'],function(){
        Route::get('/', [Ly_facilityController::class,'index'])->name('facilities');
        Route::get('/summary', [Ly_facilityController::class,'summary'])->name('summary');    
        Route::get('/changes', [Ly_facilityController::class,'changes'])->name('changes');    
        Route::get('/keys', [Ly_keyController::class,'index'])->name('keys');    
    });  
});