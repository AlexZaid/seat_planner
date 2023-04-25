<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ly_spotController;

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
Route::get('/spotposition', [Ly_spotController::class,'index']);
Route::get('/spots/{floor}', [Ly_spotController::class,'spots']);
Route::get('/unassignedEmployees', [Ly_spotController::class,'unassigned_employees']);

/* Summary */
Route::get('/facilities', [Ly_spotController::class,'']);


