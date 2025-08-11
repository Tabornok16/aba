@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('public-advisories.index') }}" 
               class="text-blue-600 hover:text-blue-800">
                ← Back to Advisories
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($advisory->image)
                <div class="w-full h-96 relative">
                    <img src="{{ asset('storage/' . $advisory->image) }}" 
                         alt="{{ $advisory->title }}"
                         class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $advisory->title }}</h1>
                        <div class="text-gray-600">
                            Posted by {{ $advisory->creator->name }} • 
                            {{ $advisory->advisory_date->format('F j, Y') }}
                        </div>
                    </div>
                    @can('manage-advisory')
                    <div class="flex space-x-4">
                        <a href="{{ route('public-advisories.edit', $advisory) }}" 
                           class="text-blue-600 hover:text-blue-800">
                            Edit
                        </a>
                        <form action="{{ route('public-advisories.destroy', $advisory) }}" 
                              method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this advisory?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                Delete
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>

                <div class="prose max-w-none">
                    {!! nl2br(e($advisory->content)) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
