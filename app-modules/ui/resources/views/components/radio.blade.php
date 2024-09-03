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
    <input type="radio" class="sr-only" {{ $attributes->filter(
        fn (string $value, string $key) => in_array($key, $inputAttributes)
    ) }}>
    <div {{ $attributes->filter(
        fn (string $value, string $key) => !in_array($key, $inputAttributes)
    )->class(['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']) }}>
        @svg('fluentui-circle-' . match($size) {
            'sm' => '12',
            default => '16',
            'lg' => '16',
        }, ['class' => 'toggle'])
    </div>
</{{ $as }}>