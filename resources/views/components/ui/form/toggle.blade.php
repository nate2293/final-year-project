@props([
    'name', 
    'label' => null, 
    'value' => false, 
    'icon' => null
])


<div {{ $attributes->only('class') }}>
    @if ($label)
        <x-ui.form.label for="{{ $name }}" class="mb-1" :icon="$icon">
            {{ $label }}
        </x-ui.form.label>
    @endif
    <div x-data="{ on: @js((bool) $value) }" class="flex items-center gap-3">

        <button type="button" @click="on = !on" :class="on ? 'bg-gray-800 dark:bg-gray-700' : 'bg-gray-300 dark:bg-gray-400'"
            class="relative inline-flex my-2 h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 dark:ring dark:bg-gray-400">
            <span :class="on ? 'translate-x-6' : 'translate-x-1'"
                class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
        </button>

        {{-- Hidden input to send the value with form submissions --}}
        <input id="{{ $name }}" type="hidden" name="{{ $name }}" :value="on ? 1 : 0">
    </div>
    
    @error($name)
        <x-ui.form.error id="{{ $name }}-error">{{ $message }}</x-ui.form.error>
    @enderror

</div>
