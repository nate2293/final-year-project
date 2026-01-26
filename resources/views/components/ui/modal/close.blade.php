@props([
    'target'
])

<x-ui.button {{ $attributes }} type="button" {{ $attributes }} x-data @click="$dispatch('close-modal', '{{ $target }}')">
    {{ $slot }}
</x-ui.button>