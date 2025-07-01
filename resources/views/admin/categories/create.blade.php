<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Category
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-sm">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">Category Name</label>
                        <input type="text" name="name" id="name" class="form-input w-full mt-1" required>
                        @error('name')
                            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Create</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
