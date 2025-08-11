<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportCategory;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        $user = Auth::user();
        $categories = ReportCategory::all();
        $statistics = $this->reportService->getReportStatistics($user);
        $recentReports = $this->reportService->getRecentReports();
        $topReporters = $this->reportService->getTopReporters();

        return view('reports.index', compact(
            'categories',
            'statistics',
            'recentReports',
            'topReporters'
        ));
    }

    public function create()
    {
        $categories = ReportCategory::all();
        return view('reports.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:report_categories,id',
            'street' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $this->reportService->createReport($request->all(), Auth::user());

        return redirect()->route('reports.index')
            ->with('success', 'Report submitted successfully.');
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    public function verify(Report $report)
    {
        $this->authorize('verify-reports');
        
        $this->reportService->verifyReport($report, Auth::user());

        return redirect()->back()
            ->with('success', 'Report verified successfully.');
    }

    public function resolve(Report $report)
    {
        $this->authorize('resolve-reports');
        
        $this->reportService->resolveReport($report);

        return redirect()->back()
            ->with('success', 'Report marked as resolved.');
    }

    public function destroy(Report $report)
    {
        $this->authorize('delete-reports');
        
        $this->reportService->deleteReport($report);

        return redirect()->route('reports.index')
            ->with('success', 'Report deleted successfully.');
    }

    public function myReports()
    {
        $reports = Auth::user()->reports()
            ->with(['category', 'verifier'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $statistics = $this->reportService->getReportStatistics(Auth::user());

        return view('reports.my-reports', compact('reports', 'statistics'));
    }

    public function manage()
    {
        $this->authorize('manage-reports');

        $reports = Report::with(['user', 'category', 'verifier'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $statistics = $this->reportService->getReportStatistics();

        return view('reports.manage', compact('reports', 'statistics'));
    }
}
