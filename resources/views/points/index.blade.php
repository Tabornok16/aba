@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Points Summary -->
    <div class="bg-red-500 text-white rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-bold mb-2">{{ Auth::user()->name }}</h2>
        <div class="text-4xl font-bold mb-2">{{ number_format(Auth::user()->total_points, 2) }} points</div>
        <div class="text-lg">{{ Auth::user()->mobile_number }}</div>
        <button onclick="document.getElementById('redeemModal').classList.remove('hidden')" 
                class="mt-4 bg-white text-red-500 px-6 py-2 rounded-full font-semibold hover:bg-red-100">
            Redeem Now
        </button>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <!-- Recent Points History -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold mb-4">Recent Activity</h3>
            <div class="space-y-4">
                @foreach($pointsHistory as $point)
                    <div class="flex justify-between items-center border-b pb-2">
                        <div>
                            <div class="font-medium">{{ $point->description }}</div>
                            <div class="text-sm text-gray-500">{{ $point->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="font-semibold {{ $point->type === 'earned' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $point->type === 'earned' ? '+' : '-' }}{{ number_format($point->amount, 2) }}
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('points.history') }}" class="block text-center mt-4 text-blue-600 hover:text-blue-800">
                View All History
            </a>
        </div>

        <!-- Leaderboard -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold mb-4">Community Leaderboard</h3>
            <div class="space-y-4">
                @foreach($leaderboard as $index => $user)
                    <div class="flex items-center space-x-4 border-b pb-2">
                        <div class="font-bold w-8">{{ $index + 1 }}</div>
                        <div class="flex-1">
                            <div class="font-medium">{{ $user->name }}</div>
                            @if($user->current_rank)
                                <div class="text-sm text-gray-500">{{ $user->current_rank->name }}</div>
                            @endif
                        </div>
                        <div class="font-semibold">{{ number_format($user->total_points, 2) }}</div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('points.leaderboard') }}" class="block text-center mt-4 text-blue-600 hover:text-blue-800">
                View Full Leaderboard
            </a>
        </div>
    </div>
</div>

<!-- Redeem Modal -->
<div id="redeemModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-8 max-w-md w-full">
        <h3 class="text-2xl font-bold mb-4">Redeem Points</h3>
        <form action="{{ route('points.redeem') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">
                    Amount
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="amount" type="number" name="amount" required min="1" step="0.01">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="description" type="text" name="description" required>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" 
                        onclick="document.getElementById('redeemModal').classList.add('hidden')"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </button>
                <button type="submit" 
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Redeem
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
