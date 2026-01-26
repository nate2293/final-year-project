@props([
    'level' => 1,
    'size' => null,  // Allow visual override
])

@php
    $tag = 'h' . $level;
    // Use size prop, otherwise default to level
    $visualSize = $size ?? $level;
    
    $classes = match ((int) $visualSize) {
        1 => 'text-3xl md:text-4xl lg:text-5xl font-extrabold',
        2 => 'text-2xl md:text-3xl lg:text-4xl font-bold',
        3 => 'text-xl md:text-2xl lg:text-3xl font-bold',
        4 => 'text-base md:text-xl lg:text-2xl font-semibold',
        5 => 'text-sm md:text-md lg:text-xl font-semibold',
        6 => 'text-xs md:text-smd lg:text-md font-semibold',
        default => throw new \InvalidArgumentException("Size must be between 1 and 6"),
    };
@endphp

<{{ $tag }} {{ $attributes->class($classes . ' dark:text-gray-100') }}>
    {{ $slot }}
</{{ $tag }}>