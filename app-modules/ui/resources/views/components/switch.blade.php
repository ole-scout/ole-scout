@props([
    'size' => null,
    'wrapped' => false,
])
@php
    $as = $wrapped ? 'div' : 'label';
    $inputAttributes = [
        'name',
        'value',
        'checked',
        'disabled',
        'wire:model',
        'wire:model.defer',
        'wire:model.lazy',
        'wire:model.defer.lazy',
    ];
@endphp
<{{ $as }}>
    <input type="checkbox" role="switch" class="sr-only" {{ $attributes->filter(
        fn (string $value, string $key) => in_array($key, $inputAttributes)
    ) }}>
    <div {{ $attributes->filter(
        fn (string $value, string $key) => !in_array($key, $inputAttributes)
    )->class(['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']) }}>
        <div class="toggle"></div>
    </div>
</{{ $as }}>