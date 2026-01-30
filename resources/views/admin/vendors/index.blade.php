<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Vendor Approval
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white shadow rounded p-4">
                @forelse($vendors as $vendor)
                <div class="border-b py-3 flex justify-between items-center">

                    <div>
                        <p class="font-semibold">{{ $vendor->name }}</p>
                        <p class="text-sm text-gray-600">{{ $vendor->email }}</p>
                    </div>

                    <div>
                        @if(!$vendor->is_approved)
                        <form method="POST" action="{{ route('admin.vendors.approve', $vendor->id) }}">
                            @csrf
                            <button type="submit"
                                class="bg-green-600 text-white px-4 py-1 rounded inline-flex items-center z-10 relative">
                                Approve
                            </button>
                        </form>
                        @else
                        <span class="text-green-600 font-semibold">
                            Approved
                        </span>
                        @endif
                    </div>

                </div>
                @empty
                <p>No vendors found.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>