<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class SupervisorDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:supervisor']);
    }

    public function index()
    {
        $staffRole = Role::where('slug', 'staff')->first();
        $residentRole = Role::where('slug', 'resident')->first();

        $staffMembers = User::where('role_id', $staffRole->id)
            ->where('approval_status', 'approved')
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        $pendingResidents = User::where('role_id', $residentRole->id)
            ->where('approval_status', 'pending')
            ->whereHas('approver', function ($query) use ($staffRole) {
                $query->where('role_id', $staffRole->id);
            })
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        return view('dashboard.supervisor', compact(
            'staffMembers',
            'pendingResidents'
        ));
    }
}
