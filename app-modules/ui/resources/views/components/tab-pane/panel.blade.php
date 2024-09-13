@props([
    'value',
    'nextValue',
    'previousValue',
    'isActive' => false,
    'alpineState' => 'state',
])
@php
    $attributes = as_attributes($attributes, [
        'role' => 'tabpanel',
        'x-bind:id' => "\$id('tab-pane', 'tabpanel_{$value}')",
        'x-bind:aria-labelledby' => "\$id('tab-pane', 'tab_{$value}')",
        'x-cloak' => !$isActive ? true : false,
        'tabindex' => '0',
        'x-show' => "{$alpineState} === '{$value}'",
    ]);
@endphp
<div {{ $attributes }}>
    {{ $slot }}
</div>