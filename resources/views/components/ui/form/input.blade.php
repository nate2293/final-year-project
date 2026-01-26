@props([
    'name',
    'label' => null,
    'value' => null,
    'variant' => 'light',
    'type' => 'text',
    'icon' => null,
])

@php
    
     $baseClasses = $type === 'file'
        ? 'w-full bg-white block rounded-lg border border-gray-300 cursor-pointer focus:outline-none file:mr-2 file:py-2 file:px-3 file:rounded-l-md file:border-0 file:font-semibold hover:file:cursor-pointer hover:file:opacity-80 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400'
        : 'w-full border border-gray-300 rounded-lg p-2.5 text-gray-700 leading-tight focus:ring-blue-500 focus:border-blue-500 dark:focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500';

    $variantClasses = $type === 'file'
        ? match ($variant) {
            'light'  => 'file:bg-gray-100 file:text-gray-900 dark:file:bg-gray-500 dark:file:text-gray-100',
            'oblue'  => 'file:bg-blue-100 file:text-blue-700 dark:file:bg-gray-500 dark:file:text-blue-900',
            'blue'   => 'file:bg-blue-700 file:text-white',
            'gray'   => 'file:bg-gray-500 file:text-white',
            'dark'   => 'file:bg-gray-900 file:text-white',
            'green'  => 'file:bg-green-500 file:text-white',
            'red'    => 'file:bg-red-500 file:text-white',
            'yellow' => 'file:bg-yellow-400 file:text-white',
            'purple' => 'file:bg-purple-700 file:text-white',
            default  => throw new \Exception("No such input file variant: $variant"),
        }
        : '';

@endphp

<div {{ $attributes->class([
        'w-full' => ! Str::of($attributes->get('class', ''))->contains('w-'),
    ]) }}>

    @if ($label)
        <x-ui.form.label for="{{ $name }}" class="mb-2" :icon="$icon">
            {{ $label }}
        </x-ui.form.label>
    @endif

    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        aria-describedby="{{ $name }}-error"
        {{ $attributes->except('class') }}
        @class([$baseClasses, $variantClasses])
    >

    <x-ui.form.error name="{{ $name }}" />
</div> 
