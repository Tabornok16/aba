@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Current Rank Progress -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold">Your Rank Progress</h2>
            <div class="text-xl font-semibold">
                {{ number_format(Auth::user()->current_exp) }} EXP
            </div>
        </div>

        @if($rankProgress['current_rank'])
            <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                    <span>{{ $rankProgress['current_rank']->name }}</span>
                    @if($rankProgress['next_rank'])
                        <span>{{ $rankProgress['next_rank']->name }}</span>
                    @endif
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $rankProgress['progress'] }}%"></div>
                </div>
                @if($rankProgress['next_rank'])
                    <div class="text-sm text-gray-600 mt-1">
                        {{ number_format($rankProgress['exp_needed']) }} EXP needed for next rank
                    </div>
                @else
                    <div class="text-sm text-gray-600 mt-1">
                        Maximum rank achieved!
                    </div>
                @endif
            </div>
        @else
            <div class="text-gray-600">
                Start earning experience to get your first rank!
            </div>
        @endif
    </div>

    <!-- All Ranks -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-xl font-semibold">Available Ranks</h3>
        </div>
        <div class="divide-y">
            @foreach($ranks as $rank)
                <div class="p-6 flex items-center">
                    <div class="flex-1">
                        <h4 class="font-semibold">{{ $rank->name }}</h4>
                        <p class="text-gray-600">{{ $rank->description }}</p>
                        <div class="text-sm text-gray-500">Required EXP: {{ number_format($rank->required_exp) }}</div>
                    </div>
                    @if(Auth::user()->current_rank && Auth::user()->current_rank->id === $rank->id)
                        <div class="ml-4">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                Current Rank
                            </span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    @can('manage-ranks')
    <!-- Add Rank Button -->
    <div class="mt-8">
        <button onclick="document.getElementById('addRankModal').classList.remove('hidden')"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Add New Rank
        </button>
    </div>

    <!-- Add Rank Modal -->
    <div id="addRankModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
            <h3 class="text-2xl font-bold mb-4">Add New Rank</h3>
            <form action="{{ route('ranks.store') }}" method="POST">
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
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="required_exp">
                        Required Experience
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="required_exp" type="number" name="required_exp" min="0" required>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" 
                            onclick="document.getElementById('addRankModal').classList.add('hidden')"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Add Rank
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endcan
</div>
@endsection
