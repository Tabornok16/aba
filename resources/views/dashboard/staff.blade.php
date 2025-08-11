@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">Staff Dashboard</h1>
        <p class="text-gray-600">Manage resident validations and other tasks.</p>
    </div>

    <!-- Validation Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-3xl font-bold text-gray-800 mb-2">{{ $stats['total'] }}</div>
            <div class="text-gray-600">Total Residents</div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-3xl font-bold text-yellow-600 mb-2">{{ $stats['pending'] }}</div>
            <div class="text-gray-600">Pending Validation</div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-3xl font-bold text-green-600 mb-2">{{ $stats['validated'] }}</div>
            <div class="text-gray-600">Validated</div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-3xl font-bold text-red-600 mb-2">{{ $stats['rejected'] }}</div>
            <div class="text-gray-600">Rejected</div>
        </div>
    </div>

    <!-- Residents Validation Table -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold">Resident Validations</h2>
                <div class="flex space-x-4">
                    <select id="status-filter" class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="validated">Validated</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <input type="text" id="search" placeholder="Search residents..." class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Validated By</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Validated At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($validations as $validation)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $validation->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $validation->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($validation->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($validation->status === 'validated') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($validation->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $validation->validator ? $validation->validator->name : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $validation->validated_at ? $validation->validated_at->format('M d, Y H:i') : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($validation->status === 'pending')
                            <div class="flex space-x-2">
                                <form action="{{ route('resident-validations.validate', $validation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-600 hover:text-green-900">Validate</button>
                                </form>
                                <form action="{{ route('resident-validations.reject', $validation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                </form>
                            </div>
                            @else
                            <button type="button" 
                                    class="text-blue-600 hover:text-blue-900"
                                    onclick="showNotes('{{ $validation->validation_notes }}')">
                                View Notes
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No residents to validate at this time.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t">
            {{ $validations->links() }}
        </div>
    </div>
</div>

<!-- Notes Modal -->
<div id="notesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-2">Validation Notes</h3>
            <div class="mt-2 px-7 py-3">
                <p id="modalContent" class="text-sm text-gray-500"></p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="closeModal" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showNotes(notes) {
        document.getElementById('modalContent').textContent = notes || 'No notes available';
        document.getElementById('notesModal').classList.remove('hidden');
    }

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('notesModal').classList.add('hidden');
    });

    // Close modal when clicking outside
    document.getElementById('notesModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });

    // Status filter functionality
    document.getElementById('status-filter').addEventListener('change', function() {
        const status = this.value;
        const currentUrl = new URL(window.location.href);
        if (status) {
            currentUrl.searchParams.set('status', status);
        } else {
            currentUrl.searchParams.delete('status');
        }
        window.location.href = currentUrl.toString();
    });

    // Search functionality
    let searchTimeout;
    document.getElementById('search').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const search = this.value;
            const currentUrl = new URL(window.location.href);
            if (search) {
                currentUrl.searchParams.set('search', search);
            } else {
                currentUrl.searchParams.delete('search');
            }
            window.location.href = currentUrl.toString();
        }, 500);
    });
</script>
@endpush
@endsection