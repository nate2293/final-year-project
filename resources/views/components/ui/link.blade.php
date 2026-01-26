@props([
    'variant' => 'link',
    'href' => '#',
    'label' => null,
    'icon' => null,
])

@php
    $base = 'cursor-pointer transition-colors font-medium disabled:opacity-50 focus:outline-none';

    $sizes = match ($variant) {
        'link' => 'py-1.5 px-1.5',
        'none' => '',
        default => 'py-1.5 px-4 rounded-lg border',
    };

    $variants = [
        'blue'   => 'text-gray-100 bg-blue-700 border-blue-800 hover:bg-blue-900 focus:ring-1 focus:ring-blue-900 dark:bg-blue-900 dark:hover:bg-blue-800 dark:text-gray-300 dark:border-gray-700 dark:focus:ring-blue-500',
        'red'    => 'text-gray-100 bg-red-700 border-red-800 hover:bg-red-800 focus:ring-1 focus:ring-red-900 dark:bg-red-900 dark:hover:bg-red-800 dark:text-gray-300 dark:border-gray-700 dark:focus:ring-red-500',
        'green'  => 'text-gray-100 bg-green-700 border-green-800 hover:bg-green-800 focus:ring-1 focus:ring-green-900 dark:bg-green-900 dark:hover:bg-green-800 dark:text-gray-300 dark:border-gray-700 dark:focus:ring-green-500',
        'yellow' => 'text-gray-100 bg-yellow-600 border-yellow-800 hover:bg-yellow-700 focus:ring-1 focus:ring-yellow-900 dark:bg-yellow-900 dark:hover:bg-yellow-800 dark:text-gray-300 dark:border-gray-700 dark:focus:ring-yellow-500',
        'dark'   => 'text-gray-100 bg-gray-900 border-gray-200 hover:bg-gray-700 focus:ring-1 focus:ring-gray-900 dark:bg-gray-900 dark:hover:bg-gray-800 dark:text-gray-300 dark:border-gray-700 dark:focus:ring-gray-700',
        'light'  => 'text-gray-900 bg-gray-50 border-gray-200 hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-100 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700',
        'oblue'  => 'text-blue-600 bg-gray-50 border-gray-200 hover:bg-blue-600 hover:text-white dark:bg-gray-300 dark:hover:bg-blue-500 dark:hover:text-white dark:border-gray-500 dark:focus:ring-blue-800',
        'ored'   => 'text-red-600 bg-gray-50 border-gray-200 hover:bg-red-600 hover:text-white dark:bg-gray-300 dark:hover:bg-red-500 dark:hover:text-white dark:border-gray-500 dark:focus:ring-red-800',
        'link'   => 'text-gray-900 hover:underline dark:text-gray-100',
        'none'   => '',
    ];

    if (! array_key_exists($variant, $variants)) {
        throw new \InvalidArgumentException("No such button variant: {$variant}");
    }

    $classes = implode(' ', [$base, $sizes, $variants[$variant] ?? '']);
@endphp

<a href="{{ $href }}"
    {{ $attributes->class($classes)->class(['inline-flex items-center gap-1' => $icon]) }}>
    
    @if ($icon)
        <x-ui.svg :icon="$icon" class="shrink-0" />
        <span class="hidden md:inline">{{ $label ?? $slot }}</span>
    @else
        {{ $label ?? $slot }}
    @endif
</a>
