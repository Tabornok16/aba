@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Welcome to Your Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Profile Information</h2>
                <div class="space-y-3">
                    <p class="text-gray-600">
                        <span class="font-medium">Name:</span> 
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-gray-600">
                        <span class="font-medium">Email:</span> 
                        {{ Auth::user()->email }}
                    </p>
                    <p class="text-gray-600">
                        <span class="font-medium">Role:</span> 
                        {{ Auth::user()->role->name ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Quick Actions</h2>
                <div class="space-y-3">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                        Update Profile
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                        Change Password
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 rounded-md">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- System Info -->
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">System Information</h2>
                <div class="space-y-3">
                    <p class="text-gray-600">
                        <span class="font-medium">Last Login:</span> 
                        {{ now()->format('M d, Y H:i A') }}
                    </p>
                    <p class="text-gray-600">
                        <span class="font-medium">Account Status:</span> 
                        <span class="text-green-600">Active</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
