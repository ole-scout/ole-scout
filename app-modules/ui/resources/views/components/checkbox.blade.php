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
)->class(['relative', 'input', 'input-toggle', 'w-4', 'h-4', 'rounded']) }}>
    <x-fluentui-checkmark-12 class="absolute inset-0.5 if-checked" />
</div>
</label>