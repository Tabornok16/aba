@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('public-advisories.index') }}" 
               class="text-blue-600 hover:text-blue-800">
                ← Back to Advisories
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-6">Edit Public Advisory</h2>

            <form action="{{ route('public-advisories.update', $advisory) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror"
                           id="title" 
                           type="text" 
                           name="title" 
                           value="{{ old('title', $advisory->title) }}" 
                           required>
                    @error('title')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="advisory_date">
                        Advisory Date
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('advisory_date') border-red-500 @enderror"
                           id="advisory_date" 
                           type="date" 
                           name="advisory_date" 
                           value="{{ old('advisory_date', $advisory->advisory_date->format('Y-m-d')) }}" 
                           required>
                    @error('advisory_date')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                        Content
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('content') border-red-500 @enderror"
                              id="content" 
                              name="content" 
                              rows="10" 
                              required>{{ old('content', $advisory->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                        Image
                    </label>
                    @if($advisory->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $advisory->image) }}" 
                                 alt="Current image" 
                                 class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror"
                           id="image" 
                           type="file" 
                           name="image" 
                           accept="image/*">
                    <p class="text-sm text-gray-600 mt-1">Leave empty to keep the current image</p>
                    @error('image')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Update Advisory
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
