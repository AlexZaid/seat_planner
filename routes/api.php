<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ly_seatController;
use App\Http\Controllers\Ly_assignationController;
use App\Http\Controllers\Ly_keyLoanController;
use App\Http\Controllers\Ly_keyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'seat'],function(){
    Route::post('save', [Ly_seatController::class,'store']);
});

Route::group(['prefix'=>'layout'],function(){
    Route::post('save', [Ly_assignationController::class,'store']);
});

Route::group(['prefix'=>'key'],function(){
    Route::post('save', [Ly_keyController::class,'store']);
});

Route::group(['prefix'=>'keyLoan'],function(){
    Route::post('save', [Ly_keyLoanController::class,'store']);
});
