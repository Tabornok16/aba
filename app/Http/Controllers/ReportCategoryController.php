<?php

namespace App\Http\Controllers;

use App\Models\ReportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-report-categories');
    }

    public function index()
    {
        $categories = ReportCategory::withCount('reports')->get();
        return view('report-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|image|max:2048'
        ]);

        $data = $request->except('icon');

        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('report-categories', 'public');
            $data['icon'] = $path;
        }

        ReportCategory::create($data);

        return redirect()->route('report-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function update(Request $request, ReportCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('icon');

        if ($request->hasFile('icon')) {
            if ($category->icon) {
                Storage::disk('public')->delete($category->icon);
            }
            $path = $request->file('icon')->store('report-categories', 'public');
            $data['icon'] = $path;
        }

        $category->update($data);

        return redirect()->route('report-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(ReportCategory $category)
    {
        // Check if category has reports
        if ($category->reports()->count() > 0) {
            return redirect()->route('report-categories.index')
                ->with('error', 'Cannot delete category that has reports.');
        }

        if ($category->icon) {
            Storage::disk('public')->delete($category->icon);
        }

        $category->delete();

        return redirect()->route('report-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
