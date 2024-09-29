@use(Illuminate\Support\Js)
@props([
    'title' => null,
    'icon' => null,
    'footer' => null,
    'layer' => 1,
    'collapsed' => false,
])
@php
    $attributes = as_attributes($attributes);
    $title = as_slot($title);
    $icon = as_slot($icon);
    $slot = as_slot($slot);
    $footer = as_slot($footer);
@endphp
<x-ui::dialog
    :$attributes
    x-id="['collapsible']"
    :x-data="Js::from(['expanded' => !$collapsed])"
>
    @capture($header, $attributes, $slot)
    <x-ui::button
        :$attributes
        variant="neutral"
        x-on:click="expanded = !expanded"
        x-bind:aria-controls="$id('collapsible', 'content')"
        x-bind:aria-expanded="String(expanded)"
        :aria-expanded="$collapsed ? 'false' : 'true'"
        x-ui-busy:ignore
        >
        <x-slot:slot>{{ $slot }}</x-slot:slot>
        <x-slot:iconTrailing
            icon=":chevron-down"
            class="duration-100 motion-safe:transition-transform"
            x-bind:class="expanded ? 'rotate-180' : 'rotate-0'"
        ></x-slot:iconTrailing>
    </x-ui::button>
    @endcapture
    <x-slot:header :callback="$header"></x-slot:header>
    <x-slot:icon :attributes="$icon->attributes">{{ $icon }}</x-slot:icon>
    <x-slot:title
        :attributes="$title->attributes"
        x-bind:id="$id('collapsible', 'label')"
    >{{ $title }}</x-slot:title>
    <x-slot:slot
        :attributes="$slot->attributes"
        x-bind:id="$id('collapsible', 'content')"
        x-bind:aria-labelledby="$id('collapsible', 'label')"
        x-cloak
        x-show="expanded"
    >{{ $slot }}</x-slot:slot>
    <x-slot:footer
        :attributes="$footer->attributes"
    >{{ $footer }}</x-slot:footer>
</x-ui::section>