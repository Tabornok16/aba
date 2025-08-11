<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\PointService;
use App\Services\BadgeService;
use App\Services\RankService;
use App\Services\ReportService;
use App\Models\PublicAdvisory;
use App\Models\CityOfficial;

class DashboardController extends Controller
{
    protected $pointService;
    protected $badgeService;
    protected $rankService;
    protected $reportService;

    public function __construct(
        PointService $pointService,
        BadgeService $badgeService,
        RankService $rankService,
        ReportService $reportService
    ) {
        $this->middleware('auth');
        $this->pointService = $pointService;
        $this->badgeService = $badgeService;
        $this->rankService = $rankService;
        $this->reportService = $reportService;
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->role->slug === 'admin') {
            return redirect()->route('dashboard.admin');
        }

        if ($user->role->slug === 'manager') {
            return redirect()->route('dashboard.manager');
        }
        
        if ($user->role->slug === 'supervisor') {
            return redirect()->route('dashboard.supervisor');
        }
        
        if ($user->role->slug === 'staff') {
            return redirect()->route('dashboard.staff');
        }

        // For residents, show the resident dashboard with all features
        $rankProgress = $this->rankService->getRankProgress($user);
        $badgeProgress = $this->badgeService->getBadgeProgress($user);
        $reportStats = $this->reportService->getReportStatistics($user);
        $recentReports = $this->reportService->getRecentReports(3);
        $leaderboard = $this->pointService->getLeaderboard(5);
        $cityOfficials = CityOfficial::active()->ordered()->take(4)->get();
        $publicAdvisories = PublicAdvisory::latest('advisory_date')->take(3)->get();
        $unreadNotifications = $user->unreadNotifications()->take(5)->get();

        return view('dashboard', compact(
            'user',
            'rankProgress',
            'badgeProgress',
            'reportStats',
            'recentReports',
            'leaderboard',
            'cityOfficials',
            'publicAdvisories',
            'unreadNotifications'
        ));
    }
}