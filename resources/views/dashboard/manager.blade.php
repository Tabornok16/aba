@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Manager Dashboard</h1>

        <!-- Pending Supervisors -->
        <x-user-list 
            :users="$pendingSupervisors" 
            title="Pending Supervisor Approvals"
            :showActions="true"
        />

        <!-- Pending Staff -->
        <x-user-list 
            :users="$pendingStaff" 
            title="Pending Staff Approvals"
            :showActions="true"
        />

        <!-- Approved Users -->
        <x-user-list 
            :users="$approvedUsers" 
            title="Recently Approved Users"
        />

        <!-- Rejected Users -->
        <x-user-list 
            :users="$rejectedUsers" 
            title="Recently Rejected Users"
        />
    </div>
</div>
@endsection
