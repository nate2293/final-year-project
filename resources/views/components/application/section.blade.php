@props([
    'title',
])

<div class="border-t border-gray-200 dark:border-gray-700 py-8">

    <x-ui::heading level="4">
        {{ $title }}
    </x-ui::heading>

    <div class="mt-4">
        {{ $slot }}
    </div>

</div>