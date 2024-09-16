@props([
    'label',
    'description' => null,
])
@php
    $attributes = as_attributes($attributes);
    $label = as_slot($label);
    $description = as_slot($description);
    $slot = as_slot($slot);
@endphp
<x-ui::section
    :$attributes
    x-id="['collapsible']"
    x-data="{'expanded': false}"
>
    @capture($header, $attributes, $slot)
    <x-ui::button
        :$attributes
        variant="neutral"
        x-on:click="expanded = !expanded"
        x-bind:aria-controls="$id('collapsible', 'content')"
        x-bind:aria-expanded="String(expanded)"
        aria-expanded="false"
        >
        <x-slot:slot>{{ $slot }}</x-slot:slot>
        <x-slot:iconTrailing
            class="duration-100 motion-safe:transition-transform"
            x-bind:class="expanded ? 'rotate-180' : 'rotate-0'"
        >chevron-down</x-slot:iconTrailing>
    </x-ui::buton>
    @endcapture
    <x-slot:header :callback="$header"></x-slot:header>
    <x-slot:label
        :attributes="$label->attributes"
        x-bind:id="$id('collapsible', 'label')"
    >{{ $label }}</x-slot:label>
    <x-slot:description
        :attributes="$description->attributes"
    >{{ $description }}</x-slot:description>
    <x-slot:slot
        :attributes="$slot->attributes"
        x-bind:id="$id('collapsible', 'content')"
        x-bind:aria-labelledby="$id('collapsible', 'label')"
        x-cloak
        x-show="expanded"
    >{{ $slot }}</x-slot:slot>
</x-ui::section>