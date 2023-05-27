<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ly_assignationController;
use App\Http\Controllers\Ly_seatController;
use App\Http\Controllers\Ly_employeeController;
use App\Http\Controllers\Ly_facilityController;
use App\Http\Controllers\Ly_keyController;
use App\Http\Controllers\Ly_authController;
use App\Http\Controllers\Ly_keyLoanController;

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
    return redirect('/layout/office');
});


Route::match(['get', 'post'], '/login', [Ly_authController::class,'authenticate']);
Route::post('/logout', [Ly_authController::class,'logout']);

/* Layout */
Route::group(['prefix'=>'layout'],function(){
     Route::group(['prefix'=>'office'],function(){
        Route::get('/', [Ly_assignationController::class,'index']);
        Route::get('/seat/{floor}', [Ly_assignationController::class,'show']);
        Route::get('/unassignedEmployees', [Ly_employeeController::class,'unassigned_employees']);
        Route::get('/assignedEmployees', [Ly_employeeController::class,'assigned_employees']);
    });  
    
    Route::prefix("management")->middleware(['auth','layoutManager'])->group(function(){
        Route::group(['prefix'=>'assignation'],function(){
            Route::get('/', [Ly_assignationController::class,'index']);
            Route::get('/seat/{floor}', [Ly_assignationController::class,'show']);
            Route::get('/unassignedEmployees', [Ly_employeeController::class,'unassigned_employees']);
            Route::get('/assignedEmployees', [Ly_employeeController::class,'assigned_employees']);
        });

        Route::group(['prefix'=>'editSeats'],function(){
            Route::get('/', [Ly_seatController::class,'index']);
            Route::get('/seat/{floor}', [Ly_seatController::class,'show']);
        });
    });
});

/* Summary */
Route::prefix("summary")->middleware(['auth','layoutManager'])->group(function(){
    Route::group(['prefix'=>'facilities'],function(){
        Route::get('/', [Ly_facilityController::class,'index'])->name('facilities');
        Route::get('/summary', [Ly_facilityController::class,'summary'])->name('summary');    
        Route::get('/changes', [Ly_facilityController::class,'changes'])->name('changes');    
        Route::get('/keys', [Ly_keyController::class,'index'])->name('keys');    
        Route::post('/saveKeys', [Ly_keyController::class,'store']); 
        Route::match(['get', 'post'], '/keyLoan', [Ly_keyLoanController::class,'index']);
    });  
});