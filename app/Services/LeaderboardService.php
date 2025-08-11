<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class LeaderboardService
{
    public function getOverallLeaderboard(int $limit = 10)
    {
        return Cache::remember('overall_leaderboard', 3600, function () use ($limit) {
            return User::withSum(['points as earned_points' => function ($query) {
                    $query->where('type', 'earned');
                }], 'amount')
                ->withSum(['points as redeemed_points' => function ($query) {
                    $query->where('type', 'redeemed');
                }], 'amount')
                ->withCount(['reports as verified_reports' => function ($query) {
                    $query->whereNotNull('verified_at');
                }])
                ->withCount('badges')
                ->orderByRaw('(earned_points - COALESCE(redeemed_points, 0)) DESC')
                ->limit($limit)
                ->get()
                ->map(function ($user) {
                    $user->total_points = ($user->earned_points ?? 0) - ($user->redeemed_points ?? 0);
                    return $user;
                });
        });
    }

    public function getMonthlyLeaderboard(int $limit = 10)
    {
        $startOfMonth = now()->startOfMonth();
        
        return Cache::remember('monthly_leaderboard', 3600, function () use ($limit, $startOfMonth) {
            return User::withSum(['points as earned_points' => function ($query) use ($startOfMonth) {
                    $query->where('type', 'earned')
                        ->where('created_at', '>=', $startOfMonth);
                }], 'amount')
                ->withSum(['points as redeemed_points' => function ($query) use ($startOfMonth) {
                    $query->where('type', 'redeemed')
                        ->where('created_at', '>=', $startOfMonth);
                }], 'amount')
                ->withCount(['reports as monthly_reports' => function ($query) use ($startOfMonth) {
                    $query->where('created_at', '>=', $startOfMonth);
                }])
                ->withCount(['badges as monthly_badges' => function ($query) use ($startOfMonth) {
                    $query->where('user_badges.created_at', '>=', $startOfMonth);
                }])
                ->orderByRaw('(earned_points - COALESCE(redeemed_points, 0)) DESC')
                ->limit($limit)
                ->get()
                ->map(function ($user) {
                    $user->monthly_points = ($user->earned_points ?? 0) - ($user->redeemed_points ?? 0);
                    return $user;
                });
        });
    }

    public function getUserRank(User $user)
    {
        $key = "user_rank_{$user->id}";
        
        return Cache::remember($key, 3600, function () use ($user) {
            $totalPoints = $user->total_points;
            
            $rank = User::where('id', '!=', $user->id)
                ->withSum(['points as total_points' => function ($query) {
                    $query->where('type', 'earned');
                }], 'amount')
                ->having('total_points', '>', $totalPoints)
                ->count();

            return $rank + 1;
        });
    }

    public function getTopContributors(string $type = 'reports', int $limit = 5)
    {
        $cacheKey = "top_contributors_{$type}";

        return Cache::remember($cacheKey, 3600, function () use ($type, $limit) {
            $query = User::query();

            switch ($type) {
                case 'reports':
                    $query->withCount(['reports as count' => function ($q) {
                        $q->whereNotNull('verified_at');
                    }]);
                    break;
                case 'badges':
                    $query->withCount(['badges as count']);
                    break;
                case 'points':
                    $query->withSum(['points as count' => function ($q) {
                        $q->where('type', 'earned');
                    }], 'amount');
                    break;
            }

            return $query->orderBy('count', 'desc')
                ->limit($limit)
                ->get();
        });
    }
}
