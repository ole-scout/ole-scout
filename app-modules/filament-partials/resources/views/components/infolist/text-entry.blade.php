@props([
    'label' => null,
])
<div {{ $attributes->class(['grid gap-y-2']) }}>
    <div class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
        {{ $label }}
    </div>
    <div class="text-sm leading-6 text-gray-950 dark:text-white">
        {{ $slot }}
    </div>
</div>