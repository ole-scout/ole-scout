@props([
    'as' => 'div',
    'layer' => 1,
])
@php
    $slot = as_slot($slot);
@endphp
{{ render_slot(
    $slot,
    $attributes->class([
        match ($layer) {
            default => 'card',
            2 => 'card-2',
            3 => 'card-3',
        }
    ]),
    fallbackTag: $as
) }}