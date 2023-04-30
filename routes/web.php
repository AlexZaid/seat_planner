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

/* Layout Office */
Route::get('/layout', [Ly_spotController::class,'index']);
Route::get('/spots/{floor}', [Ly_spotController::class,'spots']);
Route::get('/unassignedEmployees', [Ly_spotController::class,'unassigned_employees']);

/* Summary */
Route::get('/site', [Ly_spotController::class,'']);
Route::get('/facilities', [Ly_spotController::class,'']);

/* Seat */
Route::group(['prefix'=>'layout'],function(){
    Route::get('/settings', [Ly_seatController::class,'index'])->name('setting');
    Route::get('/seats/{floor}', [Ly_seatController::class,'index']);
});
