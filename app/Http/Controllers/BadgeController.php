<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Services\BadgeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BadgeController extends Controller
{
    protected $badgeService;

    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
    }

    public function index()
    {
        $user = Auth::user();
        $earnedBadges = $user->badges()->orderBy('user_badges.earned_at', 'desc')->get();
        $availableBadges = Badge::whereNotIn('id', $earnedBadges->pluck('id'))->get();
        $badgeProgress = $this->badgeService->getBadgeProgress($user);

        return view('badges.index', compact('earnedBadges', 'availableBadges', 'badgeProgress'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|image|max:2048',
            'required_points' => 'required_without:required_reports|integer|min:0',
            'required_reports' => 'required_without:required_points|integer|min:0'
        ]);

        $data = $request->except('icon');

        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('badges', 'public');
            $data['icon'] = $path;
        }

        Badge::create($data);

        return redirect()->route('badges.index')
            ->with('success', 'Badge created successfully.');
    }

    public function update(Request $request, Badge $badge)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|max:2048',
            'required_points' => 'required_without:required_reports|integer|min:0',
            'required_reports' => 'required_without:required_points|integer|min:0'
        ]);

        $data = $request->except('icon');

        if ($request->hasFile('icon')) {
            if ($badge->icon) {
                Storage::disk('public')->delete($badge->icon);
            }
            $path = $request->file('icon')->store('badges', 'public');
            $data['icon'] = $path;
        }

        $badge->update($data);

        return redirect()->route('badges.index')
            ->with('success', 'Badge updated successfully.');
    }

    public function destroy(Badge $badge)
    {
        // Only allow deletion if no users have this badge
        if ($badge->users()->count() > 0) {
            return redirect()->route('badges.index')
                ->with('error', 'Cannot delete badge that has been earned by users.');
        }

        if ($badge->icon) {
            Storage::disk('public')->delete($badge->icon);
        }

        $badge->delete();

        return redirect()->route('badges.index')
            ->with('success', 'Badge deleted successfully.');
    }
}
