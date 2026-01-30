<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Category</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
            @csrf
            @method('PUT')

            <input type="text" name="name" placeholder="Category Name" value="{{ $category->name }}" class="block w-full mb-3" required>

            <select name="parent_id" class="block w-full mb-3">
                <option value="">Select Parent Category (Optional)</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" @if($category->parent_id == $parent->id) selected @endif>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>

            <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update Category</button>
        </form>
    </div>
</x-app-layout>

