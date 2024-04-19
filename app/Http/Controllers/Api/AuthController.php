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

class AuthController extends Controller
{ 
  use ApiResponse; 
private function validateRegistration(Request $request)
{
    return Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'organization_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);
}
   public function register(Request $request)
  {
    $validator = $this->validateRegistration($request);
    if ($validator->fails()) {
        return $this->validation($validator->errors()->first());
    }

    $user = User::create([
        'name' => $request->name,
        'organization_name' => $request->organization_name,
        'address' => $request->address,
        'phone' => $request->phone,
        'role' => $request->role,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    if ($user) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['status'=>'success','message' =>'Registration successfully','token' => $token ,'result'=>$user], 200);
        }
    }
    return $this->error('User registration failed.');
}
   public function login(Request $request)
    {    
        $validator= Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->validation($validator->errors()->first());
        }
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['status'=>'success','message' =>'login successfully','token' => $token ,'result'=>$user], 200);
        }

        return $this->error('Unauthorized');
    }
}
