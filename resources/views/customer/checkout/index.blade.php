<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Checkout</h2>
    </x-slot>

    <div class="p-6">
        <p class="mb-4">Payment Method: <strong>Cash on Delivery (Simulated)</strong></p>

        <form method="POST" action="{{ route('checkout.store') }}">
    @csrf
    <button class="bg-green-600 text-white px-6 py-2 rounded">
        Confirm Order
    </button>
</form>

    </div>
</x-app-layout>
