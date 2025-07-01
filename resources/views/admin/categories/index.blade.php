<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categories
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Category</a>
            </div>

            <div class="bg-white shadow-sm rounded-lg p-6">
                <table class="w-full table-auto text-left">
                    <thead>
                        <tr>
                            <th class="border-b p-2">Name</th>
                            <th class="border-b p-2">Slug</th>
                            <th class="border-b p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class="p-2">{{ $category->name }}</td>
                                <td class="p-2 text-gray-600">{{ $category->slug }}</td>
                                <td class="p-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-yellow-600 hover:underline">Edit</a>

                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="p-2 text-gray-500">No categories found.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
