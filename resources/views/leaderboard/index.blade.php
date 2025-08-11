@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- User's Position -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-2">Your Community Standing</h2>
            <div class="text-4xl font-bold text-blue-600">#{{ $userRank }}</div>
            <p class="text-gray-600 mt-2">Keep contributing to improve your rank!</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8 mb-8">
        <!-- Overall Leaderboard -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b flex justify-between items-center">
                <h3 class="text-xl font-semibold">Overall Leaderboard</h3>
                <a href="{{ route('leaderboard.overall') }}" class="text-blue-600 hover:text-blue-800">View All</a>
            </div>
            <div class="divide-y">
                @foreach($overallLeaderboard as $index => $user)
                    <div class="p-4 flex items-center">
                        <div class="font-bold text-lg w-8 {{ $index < 3 ? 'text-yellow-500' : 'text-gray-600' }}">
                            #{{ $index + 1 }}
                        </div>
                        <div class="flex-1 ml-4">
                            <div class="font-medium">{{ $user->name }}</div>
                            <div class="text-sm text-gray-500">
                                {{ $user->badges_count }} Badges • {{ $user->verified_reports }} Reports
                            </div>
                        </div>
                        <div class="font-semibold">
                            {{ number_format($user->total_points) }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Monthly Leaderboard -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b flex justify-between items-center">
                <h3 class="text-xl font-semibold">Monthly Leaders</h3>
                <a href="{{ route('leaderboard.monthly') }}" class="text-blue-600 hover:text-blue-800">View All</a>
            </div>
            <div class="divide-y">
                @foreach($monthlyLeaderboard as $index => $user)
                    <div class="p-4 flex items-center">
                        <div class="font-bold text-lg w-8 {{ $index < 3 ? 'text-yellow-500' : 'text-gray-600' }}">
                            #{{ $index + 1 }}
                        </div>
                        <div class="flex-1 ml-4">
                            <div class="font-medium">{{ $user->name }}</div>
                            <div class="text-sm text-gray-500">
                                {{ $user->monthly_badges }} Badges • {{ $user->monthly_reports }} Reports
                            </div>
                        </div>
                        <div class="font-semibold">
                            {{ number_format($user->monthly_points) }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Top Contributors -->
    <div class="grid md:grid-cols-3 gap-8">
        <!-- Top Reporters -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Top Reporters</h3>
            </div>
            <div class="divide-y">
                @foreach($topReporters as $user)
                    <div class="p-4">
                        <div class="font-medium">{{ $user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $user->count }} Reports</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Top Badge Holders -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Top Badge Holders</h3>
            </div>
            <div class="divide-y">
                @foreach($topBadgeHolders as $user)
                    <div class="p-4">
                        <div class="font-medium">{{ $user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $user->count }} Badges</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Top Point Earners -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Top Point Earners</h3>
            </div>
            <div class="divide-y">
                @foreach($topPointEarners as $user)
                    <div class="p-4">
                        <div class="font-medium">{{ $user->name }}</div>
                        <div class="text-sm text-gray-500">{{ number_format($user->count) }} Points</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
