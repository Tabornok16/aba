@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold">Monthly Leaderboard</h2>
                <div class="text-gray-600">
                    {{ now()->format('F Y') }}
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
                            {{ $user->monthly_badges }} Badges • {{ $user->monthly_reports }} Reports
                        </div>
                        @if($user->current_rank)
                            <div class="text-sm text-blue-600">{{ $user->current_rank->name }}</div>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold">{{ number_format($user->monthly_points) }}</div>
                        <div class="text-sm text-gray-500">points this month</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
