<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">My Products</h2>

            <!-- Add Product Button -->
            <a href="{{ route('vendor.products.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
                + Add Product
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        @if($products->isEmpty())
        <p class="text-gray-600">You have no products yet.</p>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($products as $product)
            <div class="border p-4 rounded shadow hover:shadow-lg transition">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover mb-2 rounded">
                @endif
                @if($product->category)
                <p class="text-gray-500 text-sm">Category: {{ $product->category->name }}</p>
                @endif
                <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                <p class="text-gray-600">Price: {{ $product->price }}</p>
                <p class="text-gray-600">Stock: {{ $product->stock }}</p>
                <div class="flex gap-2  mt-2">
                    <a href="{{ route('vendor.products.edit', $product->id) }}"
                        class="bg-yellow-500 text-white px-2 py-1 rounded">
                        Edit
                    </a>

                    <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
            @endforeach

        </div>
        @endif
    </div>
</x-app-layout>