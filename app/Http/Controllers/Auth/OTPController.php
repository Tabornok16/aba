<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OTPController extends Controller
{
    public function showVerificationForm()
    {
        return view('auth.verify-otp');
    }

    public function sendOTP(Request $request)
    {
        $user = $request->user();
        $method = $request->query('method', 'sms');
        
        if ($method === 'email') {
            $otp = $user->sendEmailOTP();
            $message = 'OTP has been sent to your email address.';
        } else {
            $otp = $user->sendSMSOTP();
            $message = 'OTP has been sent to your mobile number.';
        }

        // For testing purposes only
        session()->flash('otp_code', $otp->code);

        return back()->with('status', $message);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = $request->user();
        
        if ($user->verifyOTP($request->code)) {
            return redirect()->route('dashboard')
                ->with('status', 'Mobile number verified successfully.');
        }

        return back()->withErrors([
            'code' => 'The OTP code is invalid or has expired.',
        ]);
    }
}
