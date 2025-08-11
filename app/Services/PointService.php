<?php

namespace App\Services;

use App\Models\User;
use App\Models\Point;
use Illuminate\Support\Facades\DB;

class PointService
{
    public function awardPoints(User $user, float $amount, string $description): Point
    {
        return DB::transaction(function () use ($user, $amount, $description) {
            $point = $user->points()->create([
                'amount' => $amount,
                'description' => $description,
                'type' => 'earned'
            ]);

            // Check and award badges based on total points
            $this->checkAndAwardBadges($user);

            return $point;
        });
    }

    public function redeemPoints(User $user, float $amount, string $description): Point
    {
        return DB::transaction(function () use ($user, $amount, $description) {
            if ($user->total_points < $amount) {
                throw new \Exception('Insufficient points balance');
            }

            return $user->points()->create([
                'amount' => $amount,
                'description' => $description,
                'type' => 'redeemed'
            ]);
        });
    }

    public function checkAndAwardBadges(User $user): void
    {
        $totalPoints = $user->total_points;
        
        // Get all badges that the user qualifies for but hasn't earned yet
        $newBadges = \App\Models\Badge::where('required_points', '<=', $totalPoints)
            ->whereNotIn('id', $user->badges->pluck('id'))
            ->get();

        foreach ($newBadges as $badge) {
            $user->badges()->attach($badge->id, ['earned_at' => now()]);
        }
    }

    public function getPointsHistory(User $user)
    {
        return $user->points()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getLeaderboard(int $limit = 10)
    {
        return User::withSum(['points as total_points' => function ($query) {
                $query->where('type', 'earned');
            }], 'amount')
            ->withSum(['points as redeemed_points' => function ($query) {
                $query->where('type', 'redeemed');
            }], 'amount')
            ->orderByRaw('(total_points - COALESCE(redeemed_points, 0)) DESC')
            ->limit($limit)
            ->get();
    }
}
