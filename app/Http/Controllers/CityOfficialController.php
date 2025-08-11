<?php

namespace App\Http\Controllers;

use App\Models\CityOfficial;
use Illuminate\Http\Request;

class CityOfficialController extends Controller
{
    public function index()
    {
        $officials = CityOfficial::active()->ordered()->get();
        return view('city-officials.index', compact('officials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer|min:0'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('officials', 'public');
            $data['image'] = $path;
        }

        CityOfficial::create($data);

        return redirect()->route('city-officials.index')
            ->with('success', 'City official added successfully.');
    }

    public function update(Request $request, CityOfficial $official)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer|min:0'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('officials', 'public');
            $data['image'] = $path;
        }

        $official->update($data);

        return redirect()->route('city-officials.index')
            ->with('success', 'City official updated successfully.');
    }

    public function destroy(CityOfficial $official)
    {
        $official->update(['is_active' => false]);
        return redirect()->route('city-officials.index')
            ->with('success', 'City official removed successfully.');
    }
}
