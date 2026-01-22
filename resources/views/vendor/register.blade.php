<x-guest-layout>
    <form method="POST" action="{{ route('vendor.register.store') }}">
        @csrf

        <x-input-label value="Name" />
        <x-text-input name="name" class="block mt-1 w-full" required />

        <x-input-label value="Email" class="mt-4" />
        <x-text-input name="email" type="email" class="block mt-1 w-full" required />

        <x-input-label value="Password" class="mt-4" />
        <x-text-input name="password" type="password" class="block mt-1 w-full" required />

        <x-input-label value="Confirm Password" class="mt-4" />
        <x-text-input name="password_confirmation" type="password" class="block mt-1 w-full" required />

        <x-primary-button class="mt-4">
            Apply as Vendor
        </x-primary-button>
    </form>
</x-guest-layout>
