@props([
    'target'
])

<x-ui.button {{ $attributes }} x-data @click="$dispatch('open-modal', '{{ $target }}')">
    {{ $slot }}
</x-ui.button>