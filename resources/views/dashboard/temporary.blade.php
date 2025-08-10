@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome to Your Temporary Dashboard</h1>
            <p class="text-gray-600">Your account is pending verification by an administrator</p>
        </div>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Your temporary account will expire in <strong>{{ $remainingTime }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Account Status</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Registration Date:</span>
                    <span class="text-gray-800">{{ $user->registration_date->format('M d, Y h:i A') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Expiry Date:</span>
                    <span class="text-gray-800">{{ $expiryDate->format('M d, Y h:i A') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Verification Status:</span>
                    <span class="px-3 py-1 rounded-full text-sm 
                        @if($user->isPending()) bg-yellow-100 text-yellow-800
                        @elseif($user->isApproved()) bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($user->approval_status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Next Steps</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-600">
                <li>Your account is currently under review by our administrative staff.</li>
                <li>You will receive a notification once your account is verified.</li>
                <li>If your account is not verified within 3 days, you will need to register again.</li>
                <li>For urgent matters, please contact our support team.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
