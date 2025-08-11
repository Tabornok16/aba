@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">Welcome back, {{ $user->name }}!</h1>
        <p class="text-gray-600">Here's what's happening in your community.</p>
    </div>

    <!-- Points and Rank Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Points Card -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow-lg text-white p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-4xl font-bold mb-2">{{ number_format($user->total_points, 2) }}</h2>
                    <p class="text-red-100">Total Points</p>
                </div>
                <a href="{{ route('points.index') }}" 
                   class="bg-white text-red-600 px-4 py-2 rounded-full text-sm font-semibold hover:bg-red-50">
                    Redeem Points
                </a>
            </div>
        </div>

        <!-- Rank Card -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-semibold">Current Rank</h3>
                    <p class="text-2xl font-bold text-blue-600">
                        {{ $rankProgress['current_rank']?->name ?? 'Unranked' }}
                    </p>
                </div>
                <a href="{{ route('ranks.index') }}" class="text-blue-600 hover:text-blue-800">View All Ranks</a>
            </div>
            @if($rankProgress['next_rank'])
                <div class="mb-1 text-sm text-gray-600 flex justify-between">
                    <span>Progress to {{ $rankProgress['next_rank']->name }}</span>
                    <span>{{ number_format($rankProgress['progress']) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $rankProgress['progress'] }}%"></div>
                </div>
                <p class="mt-2 text-sm text-gray-600">
                    {{ number_format($rankProgress['exp_needed']) }} EXP needed for next rank
                </p>
            @endif
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Report Statistics -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold">Your Reports</h3>
                    <a href="{{ route('reports.create') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Submit Report
                    </a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-800">{{ $reportStats['total'] }}</div>
                        <div class="text-sm text-gray-600">Total</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-600">{{ $reportStats['pending'] }}</div>
                        <div class="text-sm text-gray-600">Pending</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600">{{ $reportStats['verified'] }}</div>
                        <div class="text-sm text-gray-600">Verified</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600">{{ $reportStats['resolved'] }}</div>
                        <div class="text-sm text-gray-600">Resolved</div>
                    </div>
                </div>
            </div>

            <!-- Recent Reports -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Recent Reports</h3>
                        <a href="{{ route('reports.my-reports') }}" class="text-blue-600 hover:text-blue-800">
                            View All
                        </a>
                    </div>
                </div>
                <div class="divide-y">
                    @forelse($recentReports as $report)
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="font-medium">{{ $report->category->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $report->street }}, {{ $report->barangay }}</div>
                                    <div class="text-xs text-gray-500">{{ $report->created_at->diffForHumans() }}</div>
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($report->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($report->status === 'verified') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-600">
                            No recent reports to display.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Public Advisories -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Latest Advisories</h3>
                        <a href="{{ route('public-advisories.index') }}" class="text-blue-600 hover:text-blue-800">
                            View All
                        </a>
                    </div>
                </div>
                <div class="divide-y">
                    @forelse($publicAdvisories as $advisory)
                        <div class="p-4">
                            <h4 class="font-medium">{{ $advisory->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $advisory->content }}</p>
                            <div class="text-xs text-gray-500 mt-2">
                                Posted {{ $advisory->advisory_date->diffForHumans() }}
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-600">
                            No advisories to display.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-8">
            <!-- Badges -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Your Badges</h3>
                        <a href="{{ route('badges.index') }}" class="text-blue-600 hover:text-blue-800">View All</a>
                    </div>
                </div>
                <div class="p-6">
                    @if($user->badges->isNotEmpty())
                        <div class="grid grid-cols-3 gap-4">
                            @foreach($user->badges->take(6) as $badge)
                                <div class="text-center">
                                    @if(file_exists(public_path($badge->icon)))
                                        <img src="{{ asset($badge->icon) }}" 
                                             alt="{{ $badge->name }}"
                                             class="w-12 h-12 mx-auto mb-2">
                                    @else
                                        <div class="w-12 h-12 mx-auto mb-2 bg-blue-100 rounded-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="text-sm font-medium">{{ $badge->name }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-600">No badges earned yet.</p>
                    @endif

                    @if($badgeProgress['points_progress'])
                        <div class="mt-4">
                            <div class="text-sm font-medium mb-1">Next Badge: {{ $badgeProgress['points_progress']['badge']->name }}</div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-400 h-2 rounded-full" 
                                     style="width: {{ $badgeProgress['points_progress']['progress'] }}%"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Leaderboard -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Top Contributors</h3>
                        <a href="{{ route('leaderboard.index') }}" class="text-blue-600 hover:text-blue-800">View All</a>
                    </div>
                </div>
                <div class="divide-y">
                    @foreach($leaderboard as $index => $leader)
                        <div class="p-4 flex items-center">
                            <div class="font-bold text-lg w-8 {{ $index < 3 ? 'text-yellow-500' : 'text-gray-600' }}">
                                #{{ $index + 1 }}
                            </div>
                            <div class="flex-1">
                                <div class="font-medium">{{ $leader->name }}</div>
                                <div class="text-sm text-gray-600">{{ number_format($leader->total_points) }} points</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- City Officials -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">City Officials</h3>
                        <a href="{{ route('city-officials.index') }}" class="text-blue-600 hover:text-blue-800">View All</a>
                    </div>
                </div>
                <div class="divide-y">
                    @foreach($cityOfficials as $official)
                        <div class="p-4 flex items-center">
                            <div class="w-12 h-12 flex-shrink-0">
                                @if($official->image && file_exists(public_path('storage/' . $official->image)))
                                    <img src="{{ asset('storage/' . $official->image) }}" 
                                         alt="{{ $official->name }}"
                                         class="w-full h-full rounded-full object-cover">
                                @else
                                    <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="font-medium">{{ $official->name }}</div>
                                <div class="text-sm text-gray-600">{{ $official->position }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Notifications -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Notifications</h3>
                        <a href="{{ route('notifications.index') }}" class="text-blue-600 hover:text-blue-800">View All</a>
                    </div>
                </div>
                <div class="divide-y">
                    @forelse($unreadNotifications as $notification)
                        <div class="p-4">
                            <div class="font-medium">{{ $notification->data['message'] }}</div>
                            <div class="text-sm text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</div>
                            @if(isset($notification->data['action_url']))
                                <a href="{{ $notification->data['action_url'] }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm">
                                    View Details
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-600">
                            No unread notifications.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection