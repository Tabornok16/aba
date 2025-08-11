@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h2 class="text-2xl font-bold">Report Categories</h2>
            <button onclick="document.getElementById('addCategoryModal').classList.remove('hidden')"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Add Category
            </button>
        </div>

        <div class="divide-y">
            @foreach($categories as $category)
                <div class="p-6">
                    <div class="md:flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-16 h-16 flex-shrink-0">
                                <img src="{{ asset('storage/' . $category->icon) }}" 
                                     alt="{{ $category->name }}"
                                     class="w-full h-full object-contain">
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                                <p class="text-gray-600">{{ $category->description }}</p>
                                <div class="text-sm text-gray-500">
                                    {{ $category->reports_count }} Reports
                                </div>
                            </div>
                        </div>
                        <div class="md:ml-6 mt-4 md:mt-0 flex space-x-4">
                            <button onclick="editCategory('{{ $category->id }}')"
                                    class="text-blue-600 hover:text-blue-800">
                                Edit
                            </button>
                            @if($category->reports_count === 0)
                                <form action="{{ route('report-categories.destroy', $category) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
            <h3 class="text-2xl font-bold mb-4">Add Category</h3>
            <form action="{{ route('report-categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="name" type="text" name="name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="icon">
                        Icon
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="icon" type="file" name="icon" accept="image/*" required>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" 
                            onclick="document.getElementById('addCategoryModal').classList.add('hidden')"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
            <h3 class="text-2xl font-bold mb-4">Edit Category</h3>
            <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_name">
                        Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="edit_name" type="text" name="name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_description">
                        Description
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="edit_description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_icon">
                        Icon
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="edit_icon" type="file" name="icon" accept="image/*">
                    <p class="text-sm text-gray-600 mt-1">Leave empty to keep the current icon</p>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" 
                            onclick="document.getElementById('editCategoryModal').classList.add('hidden')"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editCategory(id) {
    const category = @json($categories);
    const currentCategory = category.find(c => c.id === id);
    
    document.getElementById('edit_name').value = currentCategory.name;
    document.getElementById('edit_description').value = currentCategory.description;
    document.getElementById('editCategoryForm').action = `/report-categories/${id}`;
    
    document.getElementById('editCategoryModal').classList.remove('hidden');
}
</script>
@endpush
@endsection
