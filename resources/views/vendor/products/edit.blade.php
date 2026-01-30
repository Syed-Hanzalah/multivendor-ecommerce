<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Product</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('vendor.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input name="name" placeholder="Product Name" value="{{ $product->name }}" class="block w-full mb-3" required>
            <input name="price" type="number" step="0.01" placeholder="Price" value="{{ $product->price }}" class="block w-full mb-3" required>
            <input name="stock" type="number" placeholder="Stock" value="{{ $product->stock }}" class="block w-full mb-3" required>
            <textarea name="description" placeholder="Description" class="block w-full mb-3">{{ $product->description }}</textarea>

            <!-- Category Dropdown -->
            <select name="category_id" class="block w-full mb-3">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                    @foreach($category->children as $child)
                        <option value="{{ $child->id }}" @if($product->category_id == $child->id) selected @endif>
                            -- {{ $child->name }}
                        </option>
                    @endforeach
                @endforeach
            </select>

            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="w-48 mb-3 rounded">
            @endif

            <input type="file" name="image" accept="image/*" class="block w-full mb-3">

            <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update Product</button>
        </form>
    </div>
</x-app-layout>
