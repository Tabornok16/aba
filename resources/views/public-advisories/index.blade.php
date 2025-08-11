@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Public Advisories</h2>
        @can('create-advisory')
        <a href="{{ route('public-advisories.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Create Advisory
        </a>
        @endcan
    </div>

    <div class="grid gap-6">
        @foreach($advisories as $advisory)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="md:flex">
                    @if($advisory->image)
                        <div class="md:flex-shrink-0">
                            <img class="h-48 w-full md:w-48 object-cover" 
                                 src="{{ asset('storage/' . $advisory->image) }}" 
                                 alt="{{ $advisory->title }}">
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-semibold mb-2">
                                    <a href="{{ route('public-advisories.show', $advisory) }}" 
                                       class="hover:text-blue-600">
                                        {{ $advisory->title }}
                                    </a>
                                </h3>
                                <div class="text-gray-600 text-sm mb-4">
                                    Posted by {{ $advisory->creator->name }} • 
                                    {{ $advisory->advisory_date->format('F j, Y') }}
                                </div>
                            </div>
                            @can('manage-advisory')
                            <div class="flex space-x-2">
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
                        <p class="text-gray-600 line-clamp-3">{{ $advisory->content }}</p>
                        <a href="{{ route('public-advisories.show', $advisory) }}" 
                           class="inline-block mt-4 text-blue-600 hover:text-blue-800">
                            Read More →
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $advisories->links() }}
    </div>
</div>
@endsection
