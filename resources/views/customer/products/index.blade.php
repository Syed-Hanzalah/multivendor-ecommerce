<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">All Products</h2>
    </x-slot>

    <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($products as $product)
            <div class="border p-4 rounded shadow hover:shadow-lg transition">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover mb-2 rounded">
                @endif
                <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                <p class="text-gray-500 text-sm">
                    Category: {{ $product->category ? $product->category->name : 'N/A' }}
                </p>
                <p class="text-gray-600">Price: ${{ $product->price }}</p>
                <p class="text-gray-600">Stock: {{ $product->stock }}</p>

                <a href="{{ route('products.show', $product->id) }}" 
                   class="bg-blue-600 text-white px-3 py-1 rounded mt-2 inline-block">
                    View Details
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>
