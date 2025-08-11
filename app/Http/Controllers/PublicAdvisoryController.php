<?php

namespace App\Http\Controllers;

use App\Models\PublicAdvisory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PublicAdvisoryController extends Controller
{
    public function index()
    {
        $advisories = PublicAdvisory::with('creator')
            ->orderBy('advisory_date', 'desc')
            ->paginate(10);

        return view('public-advisories.index', compact('advisories'));
    }

    public function show(PublicAdvisory $advisory)
    {
        return view('public-advisories.show', compact('advisory'));
    }

    public function create()
    {
        return view('public-advisories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'advisory_date' => 'required|date',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image');
        $data['created_by'] = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('advisories', 'public');
            $data['image'] = $path;
        }

        PublicAdvisory::create($data);

        return redirect()->route('public-advisories.index')
            ->with('success', 'Public advisory created successfully.');
    }

    public function edit(PublicAdvisory $advisory)
    {
        return view('public-advisories.edit', compact('advisory'));
    }

    public function update(Request $request, PublicAdvisory $advisory)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'advisory_date' => 'required|date',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($advisory->image) {
                Storage::disk('public')->delete($advisory->image);
            }
            $path = $request->file('image')->store('advisories', 'public');
            $data['image'] = $path;
        }

        $advisory->update($data);

        return redirect()->route('public-advisories.index')
            ->with('success', 'Public advisory updated successfully.');
    }

    public function destroy(PublicAdvisory $advisory)
    {
        if ($advisory->image) {
            Storage::disk('public')->delete($advisory->image);
        }

        $advisory->delete();

        return redirect()->route('public-advisories.index')
            ->with('success', 'Public advisory deleted successfully.');
    }
}
