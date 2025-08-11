<?php

namespace App\Http\Controllers;

use App\Services\PointService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    protected $pointService;

    public function __construct(PointService $pointService)
    {
        $this->pointService = $pointService;
    }

    public function index()
    {
        $user = Auth::user();
        $pointsHistory = $this->pointService->getPointsHistory($user);
        $leaderboard = $this->pointService->getLeaderboard();

        return view('points.index', compact('pointsHistory', 'leaderboard'));
    }

    public function redeem(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255'
        ]);

        try {
            $point = $this->pointService->redeemPoints(
                Auth::user(),
                $request->amount,
                $request->description
            );

            return redirect()->back()->with('success', 'Points redeemed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function history()
    {
        $pointsHistory = $this->pointService->getPointsHistory(Auth::user());
        return view('points.history', compact('pointsHistory'));
    }

    public function leaderboard()
    {
        $leaderboard = $this->pointService->getLeaderboard(20);
        return view('points.leaderboard', compact('leaderboard'));
    }
}
