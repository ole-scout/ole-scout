@props([
    'value',
    'name',
    'icon' => null,
    'checked' => false,
    'label' => null,
    'hiddenLabel' => false,
    'size' => null,
    'input' => null,
])
@php
    $attributes = as_attributes($attributes)->merge([
        'variant' => 'neutral',
        'as' => 'label',
        'wire:key' => $value,
        'hiddenLabel' => $hiddenLabel,
        'size' => $size,
    ]);
    $label = as_slot($label);
    $icon = as_slot($icon);
    $input = as_slot($input, [
        'size' => $size,
        'name' => $name,
        'value' => $value,
        'checked' => $checked
    ]);
@endphp
<x-ui::button :$attributes>
    <x-slot:icon :attributes="$icon->attributes">{{ $icon }}</x-slot:icon>
    {{ render_slot($label) }}
    <x-ui::radio :attributes="$input->attributes" />
</x-ui::button>