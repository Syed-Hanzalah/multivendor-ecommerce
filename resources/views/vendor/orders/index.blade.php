<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">My Orders</h2>
    </x-slot>

    <div class="p-6">

        @forelse($orders as $order)

            <div class="border p-4 mb-6 rounded shadow">

                <div class="flex justify-between mb-2">
                    <div>
                        <strong>Order #{{ $order->id }}</strong><br>
                        Customer: {{ $order->user->name }}
                    </div>

                    <div>
                        Status: 
                        <span class="font-semibold text-blue-600">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                {{-- items --}}
                <div class="ml-4">
                    @foreach($order->items as $item)
                        <p>
                            {{ $item->product->name }}
                            × {{ $item->quantity }}
                        </p>
                    @endforeach
                </div>

                {{-- change status --}}
                <form method="POST"
                      action="{{ route('vendor.orders.status', $order->id) }}"
                      class="mt-3">
                    @csrf

                    <select name="status" class="border p-1 rounded">
                        <option value="paid">Paid</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                    </select>

                    <button class="bg-green-600 text-white px-3 py-1 rounded">
                        Update
                    </button>
                </form>

            </div>

        @empty
            <p>No orders yet.</p>
        @endforelse

    </div>
</x-app-layout>
