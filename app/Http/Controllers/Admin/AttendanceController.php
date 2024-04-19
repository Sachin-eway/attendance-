<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
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

 public function index()
{    $org_id=Auth::user()->id;
    $employee = User::where('org_id',$org_id)->get();
    return view('admin.attendance',compact('employee'));
}

public function getAttendanceData(Request $request)
{   
    $org_id=Auth::user()->id;
    $record = Attendance::with(['user' => function ($query) use($org_id) {
                                $query->where('org_id', $org_id);
                            }]) ->latest('id');
    if(!empty($request->user_id)){
        $record->where('user_id',$request->user_id);
    }
    if(!empty($request->startDate)){
        $record->where('dateToday','>=',$request->startDate);
    } 
    if(!empty($request->endDate)){
        $record->where('dateToday','<=',$request->endDate);
    }
    $attendance=$record->get();
    return view('admin.attendanceTable',compact('attendance'));
}

}
