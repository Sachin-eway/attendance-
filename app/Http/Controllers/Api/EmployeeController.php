<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
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
 public function addEmployee(Request $request)
{
    $validator = $this->validateEmployee($request);

    if ($validator->fails()) {
        return $this->validation($validator->errors()->first());
    }

    $profilePicFullName = null;

    if ($request->hasFile('profile_pic')) {
        $profilePic = $request->file('profile_pic');
        $profilePicName = 'profile_pic_' . time() . '.' . $profilePic->getClientOriginalExtension();
        $profilePicPath = public_path('profile_image/');
        $profilePic->move($profilePicPath, $profilePicName);
        $profilePicFullName = 'profile_image/' . $profilePicName;
    }

    $user = User::create([
        'name' => $request->name,
        'organization_name' => $request->organization_name,
        'profile_pic' => $profilePicFullName, 
        'org_id' => $request->org_id,
        'address' => $request->address,
        'phone' => $request->phone,
        'role' => $request->role,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    if ($user) {
        return $this->success('Employee created successfully');
    }

    return $this->error('Employee creation failed');
}

  
}
