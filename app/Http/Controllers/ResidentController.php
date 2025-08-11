<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ResidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $residents = Resident::with('validator')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('residents.index', compact('residents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('residents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'occupation' => 'nullable|string|max:255',
            'civil_status' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'identification_type' => 'nullable|string|max:255',
            'identification_number' => 'nullable|string|max:255',
        ]);

        Resident::create($validated);

        return redirect()->route('residents.index')
            ->with('success', 'Resident registration submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resident $resident): View
    {
        return view('residents.show', compact('resident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resident $resident): View
    {
        return view('residents.edit', compact('resident'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resident $resident): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'occupation' => 'nullable|string|max:255',
            'civil_status' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'identification_type' => 'nullable|string|max:255',
            'identification_number' => 'nullable|string|max:255',
        ]);

        $resident->update($validated);

        return redirect()->route('residents.show', $resident)
            ->with('success', 'Resident information updated successfully.');
    }

    /**
     * Validate the resident registration.
     */
    public function validate_registration(Request $request, Resident $resident): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,declined',
            'remarks' => 'nullable|string|max:1000',
        ]);

        $resident->update([
            'status' => $validated['status'],
            'remarks' => $validated['remarks'],
            'validated_by' => Auth::id(),
            'validated_at' => now(),
        ]);

        $statusMessage = ucfirst($validated['status']);
        return redirect()->back()
            ->with('success', "Resident registration has been {$statusMessage}.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resident $resident): RedirectResponse
    {
        $resident->delete();

        return redirect()->route('residents.index')
            ->with('success', 'Resident record has been archived.');
    }
}
