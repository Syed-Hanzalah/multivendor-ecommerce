<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-64 object-cover mb-4 rounded">
        @endif

        <p class="text-gray-700 mb-2">{{ $product->description }}</p>
        <p class="text-gray-600 mb-1">Price: ${{ $product->price }}</p>
        <p class="text-gray-600 mb-1">Stock: {{ $product->stock }}</p>
        <p class="text-gray-600 mb-4">Category: {{ $product->category ? $product->category->name : 'N/A' }}</p>

        <form method="POST" action="{{ route('cart.add', $product->id) }}">
            @csrf
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="border px-2 py-1 rounded w-24">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded ml-2">
                Add to Cart
            </button>
        </form>
    </div>
</x-app-layout>
