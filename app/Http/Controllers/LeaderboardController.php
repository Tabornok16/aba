<?php

namespace App\Http\Controllers;

use App\Services\LeaderboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    protected $leaderboardService;

    public function __construct(LeaderboardService $leaderboardService)
    {
        $this->leaderboardService = $leaderboardService;
    }

    public function index()
    {
        $overallLeaderboard = $this->leaderboardService->getOverallLeaderboard(10);
        $monthlyLeaderboard = $this->leaderboardService->getMonthlyLeaderboard(10);
        $userRank = $this->leaderboardService->getUserRank(Auth::user());
        $topReporters = $this->leaderboardService->getTopContributors('reports', 5);
        $topBadgeHolders = $this->leaderboardService->getTopContributors('badges', 5);
        $topPointEarners = $this->leaderboardService->getTopContributors('points', 5);

        return view('leaderboard.index', compact(
            'overallLeaderboard',
            'monthlyLeaderboard',
            'userRank',
            'topReporters',
            'topBadgeHolders',
            'topPointEarners'
        ));
    }

    public function overall()
    {
        $leaderboard = $this->leaderboardService->getOverallLeaderboard(50);
        $userRank = $this->leaderboardService->getUserRank(Auth::user());

        return view('leaderboard.overall', compact('leaderboard', 'userRank'));
    }

    public function monthly()
    {
        $leaderboard = $this->leaderboardService->getMonthlyLeaderboard(50);
        return view('leaderboard.monthly', compact('leaderboard'));
    }
}
