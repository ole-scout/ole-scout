@props([
    'prefix' => null,
    'name' => null,
    'alpineState' => 'state',
])
@php
    $tabId = $prefix ? $prefix . '-' . $name : $name;
@endphp
<div
    aria-labelledby="{{ $tabId }}"
    role="tabpanel"
    tabindex="0"
    x-bind:class="
        {{ $alpineState }} === '{{ $name }}'
            ? 'fi-active p-6'
            : 'invisible absolute h-0 overflow-hidden p-0'
    "
    {{ $attributes->class(['outline-none fi-fo-tabs-tab']) }}
>
    <x-filament-partials::forms.component-container>
        {{ $slot }}
    </x-filament-partials::forms.component-container>
</div>