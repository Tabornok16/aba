@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Staff Dashboard</h1>

        <!-- Pending Residents -->
        <x-user-list 
            :users="$pendingResidents" 
            title="Pending Resident Approvals"
            :showActions="true"
        />

        <!-- Approved Residents -->
        <x-user-list 
            :users="$approvedResidents" 
            title="Recently Approved Residents"
        />

        <!-- Rejected Residents -->
        <x-user-list 
            :users="$rejectedResidents" 
            title="Recently Rejected Residents"
        />

        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Resident Validations</h2>

            <!-- Pending Validations -->
            <x-resident-list 
                :residents="$pendingValidations" 
                title="Pending Validations"
                :showActions="true"
            />

            <!-- Approved Validations -->
            <x-resident-list 
                :residents="$approvedValidations" 
                title="Recently Approved Validations"
            />

            <!-- Declined Validations -->
            <x-resident-list 
                :residents="$declinedValidations" 
                title="Recently Declined Validations"
            />
        </div>
    </div>
</div>
@endsection
