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
)->class(['relative', 'input', 'input-toggle', match($size) {
    'sm' => 'w-6 h-3',
    default => 'w-8 h-4',
    'lg' => 'w-10 h-5',
}, 'rounded-full flex items-center [:not(:checked,:disabled)+&]:bg-gray-500 dark:[:not(:checked,:disabled)+&]:bg-gray-950 justify-start px-[0.125rem]']) }}>
<div class="rounded-full bg-white [:not(:disabled)+.input>&]:shadow {{ match($size) {
    'sm' => 'w-2 h-2 [:checked+.input>&]:translate-x-[0.6875rem]',
    default => 'w-3 h-3 [:checked+.input>&]:translate-x-[0.9375rem]',
    'lg' => 'w-4 h-4 [:checked+.input>&]:translate-x-[1.1875rem]',
} }} transform translate-x-0 motion-safe:transition-transform duration-200"></div>
</div>
</label>