<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Categories</h2>
            <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                + Add Category
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        @foreach($categories as $category)
            <div class="border p-3 mb-2 rounded shadow">
                <div class="flex justify-between items-center">
                    <span class="font-semibold">{{ $category->name }}</span>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                        </form>
                    </div>
                </div>

                @if($category->children->count())
                    <div class="ml-6 mt-2">
                        @foreach($category->children as $child)
                            <div class="flex justify-between items-center mb-1">
                                <span>-- {{ $child->name }}</span>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.categories.edit', $child->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $child->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
