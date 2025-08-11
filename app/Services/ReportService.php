<?php

namespace App\Services;

use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReportService
{
    protected $pointService;
    protected $badgeService;

    public function __construct(PointService $pointService, BadgeService $badgeService)
    {
        $this->pointService = $pointService;
        $this->badgeService = $badgeService;
    }

    public function createReport(array $data, User $user): Report
    {
        return DB::transaction(function () use ($data, $user) {
            $data['user_id'] = $user->id;
            
            if (isset($data['image']) && $data['image']) {
                $path = $data['image']->store('reports', 'public');
                $data['image'] = $path;
            }

            $report = Report::create($data);

            // Award points for submitting a report
            $this->pointService->awardPoints($user, 50, 'Submitted a new report');

            // Check for new badges
            $this->badgeService->checkAndAwardBadges($user);

            return $report;
        });
    }

    public function verifyReport(Report $report, User $verifier): void
    {
        DB::transaction(function () use ($report, $verifier) {
            $report->update([
                'status' => 'verified',
                'verified_by' => $verifier->id,
                'verified_at' => now()
            ]);

            // Award points to the reporter for getting their report verified
            $this->pointService->awardPoints($report->user, 100, 'Report verified by staff');

            // Check for new badges
            $this->badgeService->checkAndAwardBadges($report->user);
        });
    }

    public function resolveReport(Report $report): void
    {
        $report->update([
            'status' => 'resolved'
        ]);

        // Award additional points for report resolution
        $this->pointService->awardPoints($report->user, 150, 'Report resolved');

        // Check for new badges
        $this->badgeService->checkAndAwardBadges($report->user);
    }

    public function deleteReport(Report $report): void
    {
        if ($report->image) {
            Storage::disk('public')->delete($report->image);
        }

        $report->delete();
    }

    public function getReportStatistics(User $user = null)
    {
        $query = Report::query();

        if ($user) {
            $query->where('user_id', $user->id);
        }

        return [
            'total' => $query->count(),
            'pending' => $query->where('status', 'pending')->count(),
            'verified' => $query->where('status', 'verified')->count(),
            'resolved' => $query->where('status', 'resolved')->count()
        ];
    }

    public function getRecentReports(int $limit = 5)
    {
        return Report::with(['user', 'category', 'verifier'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getTopReporters(int $limit = 5)
    {
        return User::withCount(['reports as verified_reports' => function ($query) {
                $query->whereNotNull('verified_at');
            }])
            ->having('verified_reports', '>', 0)
            ->orderByDesc('verified_reports')
            ->limit($limit)
            ->get();
    }
}
