@props([
    'name',
    'label' => null,
    'length' => 6,
    'icon' => null,
])

<div {{ $attributes->only('class') }}>
   @if ($label)
        <x-ui.form.label for="{{ $name }}" class="mb-2" :icon="$icon">
            {{ $label }}
        </x-ui.form.label>
    @endif

    <div x-data class="flex items-center  gap-2">
        @foreach(range(1, $length) as $index)
            <x-ui.form.input name="{{ $name }}[]" 
                              class="w-8"  
                              maxlength="1" 
                              minlength="1" 
                              x-ref="i{{ $index }}" 
                              @input="$refs.i{{ $index + 1 }}.focus()" />
        @endforeach
    </div>

    @error($name)
        <x-ui.form.error id="{{ $name }}-error">{{ $message }}</x-ui.form.error>
    @enderror
</div>
