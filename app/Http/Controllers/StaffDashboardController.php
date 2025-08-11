<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResidentValidation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StaffDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:staff']);
    }

    public function index(Request $request)
    {
        // Get query parameters
        $status = $request->get('status');
        $search = $request->get('search');

        // Base query for validations
        $query = ResidentValidation::with(['user', 'validator'])
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            });

        // Get paginated results
        $validations = $query->latest()->paginate(10);

        // Get statistics
        $stats = [
            'total' => ResidentValidation::count(),
            'pending' => ResidentValidation::pending()->count(),
            'validated' => ResidentValidation::validated()->count(),
            'rejected' => ResidentValidation::rejected()->count(),
        ];

        return view('dashboard.staff', compact('validations', 'stats'));
    }

    public function validate(ResidentValidation $validation, Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000'
        ]);

        $validation->update([
            'status' => 'validated',
            'validation_notes' => $request->notes,
            'validated_by' => Auth::id(),
            'validated_at' => now()
        ]);

        return back()->with('success', 'Resident has been validated successfully.');
    }

    public function reject(ResidentValidation $validation, Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000'
        ]);

        $validation->update([
            'status' => 'rejected',
            'validation_notes' => $request->notes,
            'validated_by' => Auth::id(),
            'validated_at' => now()
        ]);

        return back()->with('success', 'Resident has been rejected.');
    }
}