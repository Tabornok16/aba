@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Badge Progress -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-2xl font-bold mb-6">Badge Progress</h2>

        @if($badgeProgress['points_progress'])
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Next Points Badge: {{ $badgeProgress['points_progress']['badge']->name }}</h3>
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                    <span>{{ number_format($badgeProgress['points_progress']['current']) }} / {{ number_format($badgeProgress['points_progress']['required']) }} points</span>
                    <span>{{ number_format($badgeProgress['points_progress']['progress']) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $badgeProgress['points_progress']['progress'] }}%"></div>
                </div>
            </div>
        @endif

        @if($badgeProgress['reports_progress'])
            <div>
                <h3 class="text-lg font-semibold mb-2">Next Reports Badge: {{ $badgeProgress['reports_progress']['badge']->name }}</h3>
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                    <span>{{ $badgeProgress['reports_progress']['current'] }} / {{ $badgeProgress['reports_progress']['required'] }} reports</span>
                    <span>{{ number_format($badgeProgress['reports_progress']['progress']) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $badgeProgress['reports_progress']['progress'] }}%"></div>
                </div>
            </div>
        @endif
    </div>

    <!-- Earned Badges -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="p-6 border-b">
            <h3 class="text-xl font-semibold">Your Badges</h3>
        </div>
        <div class="p-6">
            @if($earnedBadges->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($earnedBadges as $badge)
                        <div class="text-center">
                            <div class="w-24 h-24 mx-auto mb-4">
                                <img src="{{ asset('storage/' . $badge->icon) }}" 
                                     alt="{{ $badge->name }}"
                                     class="w-full h-full object-contain">
                            </div>
                            <h4 class="font-semibold">{{ $badge->name }}</h4>
                            <p class="text-sm text-gray-600">{{ $badge->description }}</p>
                            <div class="text-xs text-gray-500 mt-1">
                                Earned {{ $badge->pivot->earned_at->diffForHumans() }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">You haven't earned any badges yet. Keep contributing to earn badges!</p>
            @endif
        </div>
    </div>

    <!-- Available Badges -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-xl font-semibold">Available Badges</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($availableBadges as $badge)
                    <div class="flex items-center p-4 border rounded-lg">
                        <div class="w-16 h-16 flex-shrink-0">
                            <img src="{{ asset('storage/' . $badge->icon) }}" 
                                 alt="{{ $badge->name }}"
                                 class="w-full h-full object-contain">
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold">{{ $badge->name }}</h4>
                            <p class="text-sm text-gray-600">{{ $badge->description }}</p>
                            <div class="text-sm text-gray-500 mt-1">
                                @if($badge->required_points)
                                    Required Points: {{ number_format($badge->required_points) }}
                                @endif
                                @if($badge->required_reports)
                                    Required Reports: {{ number_format($badge->required_reports) }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @can('manage-badges')
    <!-- Add Badge Button -->
    <div class="mt-8">
        <button onclick="document.getElementById('addBadgeModal').classList.remove('hidden')"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Add New Badge
        </button>
    </div>

    <!-- Add Badge Modal -->
    <div id="addBadgeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
            <h3 class="text-2xl font-bold mb-4">Add New Badge</h3>
            <form action="{{ route('badges.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="name" type="text" name="name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="icon">
                        Icon
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="icon" type="file" name="icon" accept="image/*" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="required_points">
                        Required Points
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="required_points" type="number" name="required_points" min="0">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="required_reports">
                        Required Reports
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="required_reports" type="number" name="required_reports" min="0">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" 
                            onclick="document.getElementById('addBadgeModal').classList.add('hidden')"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Add Badge
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endcan
</div>
@endsection
