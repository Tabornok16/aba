@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Points History</h2>
            <div class="text-xl font-semibold">
                Total Points: {{ number_format(Auth::user()->total_points, 2) }}
            </div>
        </div>

        <div class="space-y-4">
            @foreach($pointsHistory as $point)
                <div class="flex justify-between items-center border-b pb-4">
                    <div>
                        <div class="font-medium">{{ $point->description }}</div>
                        <div class="text-sm text-gray-500">{{ $point->created_at->format('M d, Y h:i A') }}</div>
                    </div>
                    <div class="font-semibold {{ $point->type === 'earned' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $point->type === 'earned' ? '+' : '-' }}{{ number_format($point->amount, 2) }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $pointsHistory->links() }}
        </div>
    </div>
</div>
@endsection
