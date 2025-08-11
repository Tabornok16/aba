<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;
use Illuminate\Support\Facades\DB;

class BadgeService
{
    public function checkAndAwardBadges(User $user): void
    {
        DB::transaction(function () use ($user) {
            // Check points-based badges
            $totalPoints = $user->total_points;
            $pointsBadges = Badge::where('required_points', '<=', $totalPoints)
                ->whereNotIn('id', $user->badges->pluck('id'))
                ->get();

            foreach ($pointsBadges as $badge) {
                $this->awardBadge($user, $badge);
            }

            // Check reports-based badges
            $verifiedReports = $user->reports()->whereNotNull('verified_at')->count();
            $reportsBadges = Badge::where('required_reports', '<=', $verifiedReports)
                ->whereNotIn('id', $user->badges->pluck('id'))
                ->get();

            foreach ($reportsBadges as $badge) {
                $this->awardBadge($user, $badge);
            }
        });
    }

    public function awardBadge(User $user, Badge $badge): void
    {
        $user->badges()->attach($badge->id, [
            'earned_at' => now()
        ]);

        // Award points for earning the badge
        $user->points()->create([
            'amount' => 100, // Points awarded for earning a badge
            'description' => "Earned the {$badge->name} badge",
            'type' => 'earned'
        ]);
    }

    public function getBadgeProgress(User $user): array
    {
        $totalPoints = $user->total_points;
        $verifiedReports = $user->reports()->whereNotNull('verified_at')->count();

        $nextPointsBadge = Badge::where('required_points', '>', $totalPoints)
            ->orderBy('required_points')
            ->first();

        $nextReportsBadge = Badge::where('required_reports', '>', $verifiedReports)
            ->orderBy('required_reports')
            ->first();

        $pointsProgress = null;
        if ($nextPointsBadge) {
            $pointsProgress = [
                'badge' => $nextPointsBadge,
                'current' => $totalPoints,
                'required' => $nextPointsBadge->required_points,
                'progress' => min(100, ($totalPoints / $nextPointsBadge->required_points) * 100)
            ];
        }

        $reportsProgress = null;
        if ($nextReportsBadge) {
            $reportsProgress = [
                'badge' => $nextReportsBadge,
                'current' => $verifiedReports,
                'required' => $nextReportsBadge->required_reports,
                'progress' => min(100, ($verifiedReports / $nextReportsBadge->required_reports) * 100)
            ];
        }

        return [
            'points_progress' => $pointsProgress,
            'reports_progress' => $reportsProgress
        ];
    }
}
