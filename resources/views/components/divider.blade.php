@props([
    'type' => null,
])

@if($type === 'bottom')
    <div {{ $attributes->merge(['class' => 'border-b border-gray-200 my-6']) }}></div>
@else
    <hr {{ $attributes->merge(['class' => 'border-gray-200 my-6']) }}>
@endif