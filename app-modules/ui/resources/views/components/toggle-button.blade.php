@props([
    'checked' => false,
    'onIcon' => null,
    'offIcon' => null,
    'onIconTrailing' => null,
    'offIconTrailing' => null,
    'onIconTitle' => null,
    'offIconTitle' => null,
])
@php
    $attributes = as_attributes($attributes)->merge([
        'role' => 'switch',
        'aria-checked' => $checked ? 'true' : 'false',
    ]);
    $icon = [];
    $iconTrailing = [];
    if ($onIcon) {
        $icon[] = as_slot($onIcon, [
            'hidden' => !$checked ? 'hidden' : null,
            'data-when-checked' => 'show',
            'title' => $onIconTitle,
            'aria-hidden' => 'true',
        ]);
    }
    if ($onIconTrailing) {
        $iconTrailing[] = as_slot($onIconTrailing, [
            'hidden' => !$checked ? 'hidden' : null,
            'data-when-checked' => 'show',
            'title' => $onIconTitle,
            'aria-hidden' => 'true',
        ]);
    }
    if ($offIcon) {
        $icon[] = as_slot($offIcon, [
            'hidden' => $checked ? 'hidden' : null,
            'data-when-checked' => 'hide',
            'title' => $offIconTitle,
            'aria-hidden' => 'true',
        ]);
    }
    if ($offIconTrailing) {
        $iconTrailing[] = as_slot($offIconTrailing, [
            'hidden' => $checked ? 'hidden' : null,
            'data-when-checked' => 'hide',
            'title' => $offIconTitle,
            'aria-hidden' => 'true',
        ]);
    }
    $slot = as_slot($slot);
@endphp
<x-ui::button x-ui-toggle-button:data-when-checked
    :$icon :$iconTrailing :$attributes
><x-slot:slot :attributes="$slot->attributes">{{ $slot }}</x-slot:slot></x-ui::button>