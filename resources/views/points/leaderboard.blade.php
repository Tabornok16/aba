@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-6">Community Leaderboard</h2>

        <div class="space-y-6">
            @foreach($leaderboard as $index => $user)
                <div class="flex items-center space-x-6 border-b pb-4">
                    <div class="text-2xl font-bold {{ $index < 3 ? 'text-yellow-500' : 'text-gray-600' }} w-12">
                        #{{ $index + 1 }}
                    </div>
                    <div class="flex-1">
                        <div class="font-semibold text-lg">{{ $user->name }}</div>
                        @if($user->current_rank)
                            <div class="text-gray-600">{{ $user->current_rank->name }}</div>
                        @endif
                        <div class="text-sm text-gray-500">
                            {{ $user->badges->count() }} Badges • {{ $user->reports->count() }} Reports
                        </div>
                    </div>
                    <div class="text-xl font-bold">
                        {{ number_format($user->total_points, 2) }}
                        <span class="text-sm text-gray-500">points</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
