<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\AttendanceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/ip', function () {
//      $clientIP = \Request::getClientIp(true);
//     return $clientIP;
// });
Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
});

Route::post('login',[AuthController::class ,'login'])->name('login');
Route::get('login', function () {
    if(Auth::check()){
        return redirect()->back();
    }
    return view('admin.login');
});

Route::middleware('auth')->group(function () { 
   Route::view('/', 'admin.index');
   Route::view('/dashboard','admin.index');
   Route::view('/addEmployee','admin.addemployee');
   Route::get('/employee',[EmployeeController::class ,'index'])->name('employee.index');
   Route::post('/addEmployee',[EmployeeController::class ,'store']);
   Route::get('/location',[MasterController::class ,'index']);
   Route::post('/updateLocation',[MasterController::class ,'updateLocation']);
   Route::get('/attendance',[AttendanceController::class ,'index']);
   Route::post('/getAttendanceData',[AttendanceController::class ,'getAttendanceData']);
});