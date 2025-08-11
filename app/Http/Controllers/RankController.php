<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Services\RankService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankController extends Controller
{
    protected $rankService;

    public function __construct(RankService $rankService)
    {
        $this->rankService = $rankService;
    }

    public function index()
    {
        $user = Auth::user();
        $ranks = Rank::orderBy('required_exp')->get();
        $rankProgress = $this->rankService->getRankProgress($user);
        
        return view('ranks.index', compact('ranks', 'rankProgress'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'required_exp' => 'required|integer|min:0'
        ]);

        Rank::create($request->all());

        return redirect()->route('ranks.index')
            ->with('success', 'Rank created successfully.');
    }

    public function update(Request $request, Rank $rank)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'required_exp' => 'required|integer|min:0'
        ]);

        $rank->update($request->all());

        return redirect()->route('ranks.index')
            ->with('success', 'Rank updated successfully.');
    }

    public function destroy(Rank $rank)
    {
        // Only allow deletion if no users have this rank
        if ($rank->users()->count() > 0) {
            return redirect()->route('ranks.index')
                ->with('error', 'Cannot delete rank that is assigned to users.');
        }

        $rank->delete();

        return redirect()->route('ranks.index')
            ->with('success', 'Rank deleted successfully.');
    }
}
