<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($topic) ? __('Edit Topic') : __('Create Topic') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ isset($topic) ? route('admin.topics.update', $topic) : route('admin.topics.store') }}" method="POST">
                        @csrf
                        @if(isset($topic))
                            @method('PUT')
                        @endif

                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Topic Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                                :value="old('name', $topic->name ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Slug -->
                        <div class="mb-4">
                            <x-input-label for="slug" :value="__('URL Slug')" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" 
                                :value="old('slug', $topic->slug ?? '')" />
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Leave blank to auto-generate</p>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea id="description" name="description" rows="3" class="mt-1 block w-full"
                                >{{ old('description', $topic->description ?? '') }}</x-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ isset($topic) ? __('Update Topic') : __('Create Topic') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>