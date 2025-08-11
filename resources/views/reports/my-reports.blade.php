@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Report Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-600">Total Reports</div>
            <div class="text-3xl font-bold">{{ $statistics['total'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-600">Pending</div>
            <div class="text-3xl font-bold text-yellow-600">{{ $statistics['pending'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-600">Verified</div>
            <div class="text-3xl font-bold text-blue-600">{{ $statistics['verified'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-600">Resolved</div>
            <div class="text-3xl font-bold text-green-600">{{ $statistics['resolved'] }}</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h2 class="text-2xl font-bold">My Reports</h2>
            <a href="{{ route('reports.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Submit New Report
            </a>
        </div>

        <div class="divide-y">
            @foreach($reports as $report)
                <div class="p-6">
                    <div class="md:flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <h3 class="text-lg font-semibold">{{ $report->category->name }}</h3>
                                <span class="ml-4 px-2 py-1 text-xs font-semibold rounded-full
                                    @if($report->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($report->status === 'verified') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </div>
                            <div class="text-gray-600 mb-2">{{ $report->street }}, {{ $report->barangay }}</div>
                            <p class="text-gray-700">{{ $report->description }}</p>
                            <div class="text-sm text-gray-500 mt-2">
                                Submitted {{ $report->created_at->diffForHumans() }}
                                @if($report->verifier)
                                    • Verified by {{ $report->verifier->name }}
                                @endif
                            </div>
                        </div>
                        @if($report->image)
                            <div class="md:ml-6 mt-4 md:mt-0">
                                <img src="{{ asset('storage/' . $report->image) }}" 
                                     alt="Report Image"
                                     class="w-32 h-32 object-cover rounded">
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="p-6 border-t">
            {{ $reports->links() }}
        </div>
    </div>
</div>
@endsection
