
@props([
    'name' => null,
    'icon' => null,
])


@php
    // If the group injected a name, it overrides the prop
    $name = $name ?? ($__data['name'] ?? null);
@endphp

<label for="{{ $name }}" {{ $attributes->class(['flex items-center gap-2 font-medium text-gray-700 dark:text-gray-300']) }}>
    @if($icon)
        <x-ui.svg  :icon="$icon"  class="w-4 h-4 text-gray-400 dark:text-gray-500" />
    @endif
    <span>{{ $slot }}</span>
</label>
