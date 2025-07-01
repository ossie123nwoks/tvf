<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($series) ? __('Edit Series') : __('Create Series') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ isset($series) ? route('admin.series.update', $series) : route('admin.series.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($series))
                            @method('PUT')
                        @endif

                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Series Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                                :value="old('name', $series->name ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea id="description" name="description" rows="4" class="mt-1 block w-full"
                                >{{ old('description', $series->description ?? '') }}</x-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Cover Image')" />
                            <x-file-input id="image" name="image" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            
                            @if(isset($series) && $series->image)
                                <div class="mt-2 flex items-center">
                                    <img src="{{ asset('storage/' . $series->image) }}" alt="Current cover" class="h-16 w-16 rounded-md object-cover">
                                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">Current image</span>
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ isset($series) ? __('Update Series') : __('Create Series') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>