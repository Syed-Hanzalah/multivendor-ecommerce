<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Add Category</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Category Name" class="block w-full mb-3" required>

            <select name="parent_id" class="block w-full mb-3">
                <option value="">Select Parent Category (Optional)</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>

            <button class="bg-green-600 text-white px-4 py-2 rounded">Save Category</button>
        </form>
    </div>
</x-app-layout>
