@props([
    'subtle' => false,
    'vertical' => false,
])
@php
    $attributes = as_attributes($attributes)->class(
        ['toggle-group', 'subtle' => $subtle, 'vertical' => $vertical]
    );
    $slot = as_slot($slot);
@endphp
{{ render_slot($slot, $attributes) }}