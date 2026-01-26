@props([
    'label' => null,
    'name',
    'value' => null,
    'options' => [],
    'placeholder' => 'Choose option...',
    'icon' => null,
])

<div {{ $attributes->only('class') }}>
    @if ($label)
        <x-ui.form.label for="{{ $name }}" class="mb-1" :icon="$icon">
            {{ $label }}
        </x-ui.form.label>
    @endif

    <!--classes appearance-none and bg-transparent are needed by safari -->
    <select
        {{ $attributes->merge(['id' => $name, 'name' => $name])->class('appearance-none bg-transparent bg-white border border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5') }}>
        @if ($placeholder)
            <option value="" @selected(empty($value))>{{ $placeholder }}</option>
        @endif
        @foreach ($options as $key => $label)
            <option value="{{ $key }}" @selected((string) $value == (string) $key)>
                {{ $label }}
            </option>
        @endforeach
    </select>

    @error($name)
        <x-ui.form.error id="{{ $name }}-error">{{ $message }}</x-ui.form.error>
    @enderror
</div>
