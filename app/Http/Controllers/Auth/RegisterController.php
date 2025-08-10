<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\AgeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $roles = Role::where('slug', '!=', 'super-admin')->get();
        $ageGroups = AgeGroup::all();
        
        return view('auth.register', compact('roles', 'ageGroups'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role_id' => ['required', 'exists:roles,id'],
            'age_group_id' => ['required', 'exists:age_groups,id'],
            'mobile_number' => ['required', 'string', 'regex:/^[0-9]{11}$/', 'unique:users'],
        ]);

        // Prevent registration with super-admin role
        if (Role::find($request->role_id)->slug === 'super-admin') {
            return back()->withErrors(['role_id' => 'Invalid role selected.']);
        }

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'age_group_id' => $request->age_group_id,
            'mobile_number' => $request->mobile_number,
            'is_mobile_verified' => false,
        ]);

        Auth::login($user);

        // Send OTP immediately after registration
        $otp = $user->sendSMSOTP(); // Using SMS OTP for mobile verification
        session()->flash('otp_code', $otp->code); // For testing purposes

        return redirect()->route('verify.otp')
            ->with('status', 'Please verify your mobile number.');
    }
}
