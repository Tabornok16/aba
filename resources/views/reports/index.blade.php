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

    <!-- Report Categories -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="p-6 border-b">
            <h2 class="text-2xl font-bold">Select a Category to Report</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('reports.create', ['category' => $category->id]) }}" 
                       class="flex flex-col items-center p-4 border rounded-lg hover:bg-gray-50">
                        <div class="w-16 h-16 mb-4">
                            <img src="{{ asset('storage/' . $category->icon) }}" 
                                 alt="{{ $category->name }}"
                                 class="w-full h-full object-contain">
                        </div>
                        <div class="text-center">
                            <div class="font-semibold">{{ $category->name }}</div>
                            <div class="text-sm text-gray-600">{{ $category->description }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <!-- Recent Reports -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b flex justify-between items-center">
                <h3 class="text-xl font-semibold">Recent Reports</h3>
                <a href="{{ route('reports.my-reports') }}" class="text-blue-600 hover:text-blue-800">View My Reports</a>
            </div>
            <div class="divide-y">
                @foreach($recentReports as $report)
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="font-medium">{{ $report->category->name }}</div>
                                <div class="text-sm text-gray-600">{{ $report->street }}, {{ $report->barangay }}</div>
                                <div class="text-xs text-gray-500">
                                    Reported by {{ $report->user->name }} • {{ $report->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="ml-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($report->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($report->status === 'verified') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Top Reporters -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-xl font-semibold">Top Reporters</h3>
            </div>
            <div class="divide-y">
                @foreach($topReporters as $reporter)
                    <div class="p-4 flex items-center">
                        <div class="flex-1">
                            <div class="font-medium">{{ $reporter->name }}</div>
                            <div class="text-sm text-gray-600">{{ $reporter->verified_reports }} Verified Reports</div>
                        </div>
                        @if($reporter->badges->isNotEmpty())
                            <div class="flex -space-x-2">
                                @foreach($reporter->badges->take(3) as $badge)
                                    <img src="{{ asset('storage/' . $badge->icon) }}" 
                                         alt="{{ $badge->name }}"
                                         class="w-8 h-8 rounded-full border-2 border-white"
                                         title="{{ $badge->name }}">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
