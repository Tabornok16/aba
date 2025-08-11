<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->role->slug === 'admin') {
            return redirect()->route('dashboard.admin');
        }

        if ($user->role->slug === 'manager') {
            return redirect()->route('dashboard.manager');
        }
        
        if ($user->role->slug === 'supervisor') {
            return redirect()->route('dashboard.supervisor');
        }
        
        if ($user->role->slug === 'staff') {
            return redirect()->route('dashboard.staff');
        }

        // For other roles (like residents), show a default dashboard
        return view('dashboard');
    }
}