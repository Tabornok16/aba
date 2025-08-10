@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Supervisor Dashboard</h1>

        <!-- Staff Members -->
        <x-user-list 
            :users="$staffMembers" 
            title="Staff Members"
        />

        <!-- Pending Residents -->
        <x-user-list 
            :users="$pendingResidents" 
            title="Pending Resident Approvals by Staff"
        />
    </div>
</div>
@endsection
