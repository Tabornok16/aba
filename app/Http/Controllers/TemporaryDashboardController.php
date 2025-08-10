<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemporaryDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        if (!$user->isTemporary() || !$user->isPending()) {
            return redirect()->route('dashboard');
        }

        return view('dashboard.temporary', [
            'user' => $user,
            'expiryDate' => $user->account_expiry,
            'remainingTime' => now()->diffForHumans($user->account_expiry, true),
        ]);
    }
}
