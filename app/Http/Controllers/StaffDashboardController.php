<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Voter;
use App\Models\Resident;
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

        // Get user registrations
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

        // Get resident validations
        $pendingValidations = Resident::where('status', 'pending')
            ->with('validator')
            ->latest()
            ->get();

        $approvedValidations = Resident::where('status', 'approved')
            ->where('validated_by', Auth::id())
            ->with('validator')
            ->latest()
            ->get();

        $declinedValidations = Resident::where('status', 'declined')
            ->where('validated_by', Auth::id())
            ->with('validator')
            ->latest()
            ->get();

        return view('dashboard.staff', compact(
            'pendingResidents',
            'approvedResidents',
            'rejectedResidents',
            'pendingValidations',
            'approvedValidations',
            'declinedValidations'
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

    public function verifyVoter(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
        ]);

        try {
            $voter = Voter::verifyVoter(
                $request->first_name,
                $request->last_name,
                $request->middle_name
            );

            if ($voter) {
                $user->update([
                    'voter_verified' => true,
                    'voter_id' => $voter->voter_id
                ]);
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Voter verified successfully',
                    'voter' => [
                        'name' => $voter->full_name,
                        'precinct_number' => $voter->precinct_number,
                        'address' => $voter->address
                    ]
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Voter not found in the database'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
