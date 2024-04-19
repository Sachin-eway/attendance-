<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{

    public function __construct(private readonly User $user){}

    public function index()
    {
        $employee = $this->user->where('role', 1)->get();
        return view('admin.employee', compact('employee'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'organization_name' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', 'min:8', Password::defaults()],
            'phone' => 'required'
        ]);

        $profilePicFullName = $request->hasFile('profile_pic') ? 'profile_image/' . $request->file('profile_pic')->store('profile_image') : null;

        $user = $this->user->create([
            'name' => $request->name,
            'organization_name' => Auth::user()->organization_name,
            'profile_pic' => $profilePicFullName,
            'org_id' => Auth::user()->id,
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => 1,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect()->route('employee.index')->with('success', 'Employee added successfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }
}
