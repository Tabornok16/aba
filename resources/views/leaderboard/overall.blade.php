@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold">Overall Leaderboard</h2>
                <div class="text-gray-600">
                    Your Rank: <span class="font-semibold">#{{ $userRank }}</span>
                </div>
            </div>
        </div>

        <div class="divide-y">
            @foreach($leaderboard as $index => $user)
                <div class="p-6 flex items-center">
                    <div class="font-bold text-2xl w-12 {{ $index < 3 ? 'text-yellow-500' : 'text-gray-600' }}">
                        #{{ $index + 1 }}
                    </div>
                    <div class="flex-1 ml-6">
                        <div class="font-semibold text-lg">{{ $user->name }}</div>
                        <div class="text-gray-600">
                            {{ $user->badges_count }} Badges • {{ $user->verified_reports }} Verified Reports
                        </div>
                        @if($user->current_rank)
                            <div class="text-sm text-blue-600">{{ $user->current_rank->name }}</div>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold">{{ number_format($user->total_points) }}</div>
                        <div class="text-sm text-gray-500">points</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
