<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\AttendanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post("register",[AuthController::class ,'register']);
Route::post("login",[AuthController::class ,'login']);
Route::controller(AttendanceController::class)->group(function(){ 
         Route::post('/addAttendance', 'addAttendance'); 
         Route::post('/getAtttendancedataByUserId', 'getAtttendancedataByUserId'); 
         Route::get('/getLatLongAndDistance', 'getLatLongAndDistance'); 
  });

Route::middleware('auth:sanctum')->group(function () {
  Route::controller(EmployeeController::class)->group(function(){ 
         Route::post('/AddEmployee', 'AddEmployee'); 
  });

  
});