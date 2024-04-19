<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;

class AttendanceController extends Controller
{ 
  use ApiResponse; 
private function validateEmployee(Request $request)
{
    return Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);
}
 public function addAttendance(Request $request)
{
    //$validator = $this->validateEmployee($request);
    
    $attendance=new Attendance();
    $attendance->user_id=$request->user_id;
    $attendance->dateToday=$request->dateToday;
    $attendance->activity=$request->activity;
    $attendance->save();
    
  
    if ($attendance) {
        return $this->success('Update record successfully ');
    }

    return $this->error('No record found');
}
public function getAtttendancedataByUserId(Request $request)
{   
    $today = Carbon::today();
    $attendance = Attendance::where('user_id', $request->id)
                            ->whereDate('dateToday', $today)
                            ->latest('id')->first();
  
    if ($attendance) {
        return $this->success('Attendance successfully', $attendance);
    }

    return $this->error('No attendance found for today');
}

public function getLatLongAndDistance(){
    $data=DB::table('location')->get();
    
    if($data){
        return $this->success('Location get successfully', $data);
    }
    return $this->error('Location not found');
}


  
}
