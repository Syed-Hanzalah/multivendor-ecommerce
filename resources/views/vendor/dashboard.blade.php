<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Vendor Dashboard</h2>
    </x-slot>

    <div class="p-6">
        @if(auth()->user()->isApprovedVendor())
        <p class="text-green-600 font-semibold pb-2">
            Welcome {{ auth()->user()->name }} 👋
        </p>
            <a href="{{ route('vendor.products.index') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                My Products
            </a>
            <a href="{{ route('vendor.orders') }}"
   class="bg-indigo-600 text-white px-4 py-2 rounded">
   My Orders
</a>
        @else
            <p class="text-red-500 font-semibold">
                You are not approved as a vendor yet. You cannot add products.
            </p>
        @endif
    </div>
</x-app-layout>
