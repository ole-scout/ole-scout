@props([
    'prefix' => null,
    'name' => null,
    'alpineState' => 'state',
])
@php
    $tabId = $prefix ? $prefix . '-' . $name : $name;
@endphp
<x-filament::tabs.item
    id="{{ $tabId }}"
    :alpine-active="$alpineState . ' === \'' . $name . '\''"
    :x-on:click="$alpineState . ' = \'' . $name . '\''"
    :attributes="$attributes"
>
    {{ $slot }}
</x-filament::tabs.item>