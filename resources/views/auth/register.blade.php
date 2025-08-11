@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-6xl w-full flex bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Left side - Form -->
        <div class="w-1/2 p-12">
            <h2 class="text-3xl font-bold mb-8">Sign up</h2>
            
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <div>
                    <input type="text" name="username" id="username" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-coral-500 focus:ring-1 focus:ring-coral-500" 
                        placeholder="Username"
                        required>
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="email" name="email" id="email" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-coral-500 focus:ring-1 focus:ring-coral-500" 
                        placeholder="Email"
                        required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative">
                    <input type="password" name="password" id="password" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-coral-500 focus:ring-1 focus:ring-coral-500" 
                        placeholder="Password"
                        required>
                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-coral-500 focus:ring-1 focus:ring-coral-500" 
                        placeholder="Re-type Password"
                        required>
                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>

                <div>
                    <input type="tel" name="mobile_number" id="mobile_number" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-coral-500 focus:ring-1 focus:ring-coral-500" 
                        placeholder="Mobile Number (e.g., 09123456789)"
                        pattern="[0-9]{11}"
                        required>
                    @error('mobile_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <select name="role_id" id="role_id" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-coral-500 focus:ring-1 focus:ring-coral-500"
                        required>
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <select name="age_group_id" id="age_group_id" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-coral-500 focus:ring-1 focus:ring-coral-500"
                        required>
                        <option value="">Select Age Group</option>
                        @foreach($ageGroups as $ageGroup)
                            <option value="{{ $ageGroup->id }}">{{ $ageGroup->name }} ({{ $ageGroup->description }})</option>
                        @endforeach
                    </select>
                    @error('age_group_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Sign Up
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-gray-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:text-blue-700 transition duration-200">Log in here</a>
            </p>
        </div>

        <!-- Right side - Illustration -->
        <div class="w-1/2 bg-cream-50 p-12 flex flex-col justify-center items-center">
            <img src="{{ asset('images/illustration.jpg') }}" alt="Illustration" class="max-w-md mb-8">
            <h3 class="text-2xl font-bold text-center">Let's help and contribute to a better community!</h3>
        </div>
    </div>
</div>
@endsection