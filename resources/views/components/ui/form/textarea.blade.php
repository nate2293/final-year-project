@props([
    'label' => null,
    'name',
    'value' => null,
    'icon' => null,
])

<div {{ $attributes->only('class') }}>
    @if ($label)
        <x-ui.form.label for="{{ $name }}" :icon="$icon" class="mb-2">
            {{ $label }}
        </x-ui.form.label>
    @endif

    <textarea {{ $attributes->merge([
        'id' => $name,
        'name' => $name,
        'class' => 'border border-gray-300 rounded-md w-full p-2.5 text-gray-700 leading-tight focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) 
    }}>{{ $value ?? $slot }}</textarea>

    @error($name)
        <x-ui.form.error id="{{ $name }}-error">{{ $message }}</x-ui.form.error>
    @enderror
</div>