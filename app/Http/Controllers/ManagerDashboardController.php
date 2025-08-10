<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class ManagerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager']);
    }

    public function index()
    {
        $supervisorRole = Role::where('slug', 'supervisor')->first();
        $staffRole = Role::where('slug', 'staff')->first();

        $pendingSupervisors = User::where('role_id', $supervisorRole->id)
            ->where('approval_status', 'pending')
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        $pendingStaff = User::where('role_id', $staffRole->id)
            ->where('approval_status', 'pending')
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        $approvedUsers = User::whereIn('role_id', [$supervisorRole->id, $staffRole->id])
            ->where('approval_status', 'approved')
            ->where('approved_by', auth()->id())
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        $rejectedUsers = User::whereIn('role_id', [$supervisorRole->id, $staffRole->id])
            ->where('approval_status', 'rejected')
            ->where('approved_by', auth()->id())
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        return view('dashboard.manager', compact(
            'pendingSupervisors',
            'pendingStaff',
            'approvedUsers',
            'rejectedUsers'
        ));
    }

    public function approve(User $user)
    {
        try {
            $user->approve(auth()->user());
            return redirect()->back()->with('success', 'User approved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function reject(Request $request, User $user)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        try {
            $user->reject(auth()->user(), $request->rejection_reason);
            return redirect()->back()->with('success', 'User rejected successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
