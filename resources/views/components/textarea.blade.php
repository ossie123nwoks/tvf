<textarea
    name="{{ $name }}"
    id="{{ $id }}"
    rows="{{ $rows }}"
    {{ $attributes->merge(['class' => 'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-600 sm:text-sm']) }}
>{{ $value }}</textarea>