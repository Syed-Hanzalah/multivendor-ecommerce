<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Add Product</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('vendor.products.store') }}" enctype="multipart/form-data">
            @csrf

            <input name="name" placeholder="Product Name" class="block w-full mb-3" required>
            <input name="price" type="number" step="0.01" placeholder="Price" class="block w-full mb-3" required>
            <input name="stock" type="number" placeholder="Stock" class="block w-full mb-3" required>
            <textarea name="description" placeholder="Description" class="block w-full mb-3"></textarea>
<select name="category_id" class="block w-full mb-3">
    <option value="">Select Category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @foreach($category->children as $child)
            <option value="{{ $child->id }}">-- {{ $child->name }}</option>
        @endforeach
    @endforeach
</select>

            <!-- Add Image Field -->
            <input type="file" name="image" accept="image/*" class="block w-full mb-3">

            <button class="bg-green-600 text-white px-4 py-2 rounded">Save Product</button>
        </form>

    </div>
</x-app-layout>