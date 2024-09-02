@props([
    'size' => null,
])
@php
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
<label>
<input type="checkbox" class="sr-only" {{ $attributes->filter(
    fn (string $value, string $key) => in_array($key, $inputAttributes)
) }}>
<div {{ $attributes->filter(
    fn (string $value, string $key) => !in_array($key, $inputAttributes)
)->class(['relative', 'input', 'input-toggle', 'mx-px', match($size) {
    'sm' => 'w-3 h-3',
    default => 'w-4 h-4',
    'lg' => 'w-5 h-5',
}, 'rounded-sm']) }}>
    @svg('fluentui-checkmark-' . match($size) {
        'sm' => '12',
        default => '16',
        'lg' => '16',
    }, ['class' => 'absolute if-checked ' . match($size) {
        'sm' => 'inset-0',
        default => 'inset-px',
        'lg' => 'inset-0.5',
    }])
</div>
</label>