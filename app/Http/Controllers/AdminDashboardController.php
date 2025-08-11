<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $managerRole = Role::where('slug', 'manager')->first();

        $pendingManagers = User::where('role_id', $managerRole->id)
            ->where('approval_status', 'pending')
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        $approvedManagers = User::where('role_id', $managerRole->id)
            ->where('approval_status', 'approved')
            ->where('approved_by', Auth::id())
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        $rejectedManagers = User::where('role_id', $managerRole->id)
            ->where('approval_status', 'rejected')
            ->where('approved_by', Auth::id())
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        return view('dashboard.admin', compact(
            'pendingManagers',
            'approvedManagers',
            'rejectedManagers'
        ));
    }

    public function approve(User $user)
    {
        try {
            $user->approve(Auth::user());
            return redirect()->back()->with('success', 'Manager approved successfully.');
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
            $user->reject(Auth::user(), $request->rejection_reason);
            return redirect()->back()->with('success', 'Manager rejected successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
