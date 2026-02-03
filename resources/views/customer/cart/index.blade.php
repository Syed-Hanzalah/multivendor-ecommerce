<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Shopping Cart</h2>
    </x-slot>

    <div class="p-6">
        @if(empty($cart))
            <p>Your cart is empty.</p>
        @else
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2">Product</th>
                        <th class="p-2">Price</th>
                        <th class="p-2">Qty</th>
                        <th class="p-2">Total</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp

                    @foreach($cart as $id => $item)
                        @php
                            $total = $item['price'] * $item['quantity'];
                            $grandTotal += $total;
                        @endphp
                        <tr>
                            <td class="p-2">{{ $item['name'] }}</td>
                            <td class="p-2">{{ $item['price'] }}</td>

                            <td class="p-2">
                                <form method="POST" action="{{ route('cart.update', $id) }}">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                        min="1" class="border w-16 px-1">
                                    <button class="text-blue-600 ml-1">Update</button>
                                </form>
                            </td>

                            <td class="p-2">{{ $total }}</td>

                            <td class="p-2">
                                <form method="POST" action="{{ route('cart.remove', $id) }}">
                                    @csrf
                                    <button class="text-red-600">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 font-semibold">
                Grand Total: {{ $grandTotal }}
            </div>

            <a href="{{ route('checkout') }}"
               class="inline-block mt-4 bg-green-600 text-white px-4 py-2 rounded">
                Proceed to Checkout
            </a>
        @endif
    </div>
</x-app-layout>
