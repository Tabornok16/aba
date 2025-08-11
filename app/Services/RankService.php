<?php

namespace App\Services;

use App\Models\User;
use App\Models\Rank;
use Illuminate\Support\Facades\DB;

class RankService
{
    public function addExperience(User $user, int $amount, string $source): void
    {
        DB::transaction(function () use ($user, $amount, $source) {
            $currentRank = $user->ranks()->first();
            
            if (!$currentRank) {
                // Initialize with the first rank
                $firstRank = Rank::orderBy('required_exp')->first();
                if ($firstRank) {
                    $user->ranks()->attach($firstRank->id, ['current_exp' => 0]);
                    $currentRank = $user->ranks()->first();
                }
            }

            if ($currentRank) {
                $newExp = $currentRank->pivot->current_exp + $amount;
                $user->ranks()->updateExistingPivot($currentRank->id, ['current_exp' => $newExp]);

                // Check for rank up
                $this->checkAndUpdateRank($user);
            }
        });
    }

    public function checkAndUpdateRank(User $user): void
    {
        $currentExp = $user->current_exp;
        $nextRank = Rank::where('required_exp', '>', $currentExp)
            ->orderBy('required_exp')
            ->first();

        if ($nextRank) {
            $currentRank = $user->current_rank;
            if (!$currentRank || $currentRank->required_exp < $nextRank->required_exp) {
                // User has reached a new rank
                $user->ranks()->sync([$nextRank->id => ['current_exp' => $currentExp]]);
            }
        }
    }

    public function getRankProgress(User $user): array
    {
        $currentRank = $user->current_rank;
        $nextRank = $user->next_rank;
        $currentExp = $user->current_exp;

        if (!$currentRank) {
            return [
                'current_rank' => null,
                'next_rank' => null,
                'progress' => 0,
                'exp_needed' => 0
            ];
        }

        if (!$nextRank) {
            return [
                'current_rank' => $currentRank,
                'next_rank' => null,
                'progress' => 100,
                'exp_needed' => 0
            ];
        }

        $expNeeded = $nextRank->required_exp - $currentRank->required_exp;
        $expGained = $currentExp - $currentRank->required_exp;
        $progress = ($expGained / $expNeeded) * 100;

        return [
            'current_rank' => $currentRank,
            'next_rank' => $nextRank,
            'progress' => min(100, max(0, $progress)),
            'exp_needed' => $nextRank->required_exp - $currentExp
        ];
    }
}
