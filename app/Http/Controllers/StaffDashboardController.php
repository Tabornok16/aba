<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:staff']);
    }

    public function index()
    {
        $residentRole = Role::where('slug', 'resident')->first();

        $pendingResidents = User::where('role_id', $residentRole->id)
            ->where('approval_status', 'pending')
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        $approvedResidents = User::where('role_id', $residentRole->id)
            ->where('approval_status', 'approved')
            ->where('approved_by', Auth::id())
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        $rejectedResidents = User::where('role_id', $residentRole->id)
            ->where('approval_status', 'rejected')
            ->where('approved_by', Auth::id())
            ->with(['role', 'approver'])
            ->latest()
            ->get();

        return view('dashboard.staff', compact(
            'pendingResidents',
            'approvedResidents',
            'rejectedResidents'
        ));
    }

    public function approve(User $user)
    {
        try {
            $user->approve(Auth::user());
            return redirect()->back()->with('success', 'Resident approved successfully.');
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
            return redirect()->back()->with('success', 'Resident rejected successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
