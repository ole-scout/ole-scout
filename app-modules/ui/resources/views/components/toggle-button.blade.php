@props([
    'checked' => false,
    'onIcon' => null,
    'offIcon' => null,
    'onIconTrailing' => null,
    'offIconTrailing' => null,
    'onIconTitle' => null,
    'offIconTitle' => null,
    'alpineState' => 'state',
])
@php
    $icon = ($onIcon && $offIcon) ? ['on' => $onIcon, 'off' => $offIcon] : null;
    $iconTrailing = ($onIconTrailing && $offIconTrailing) ? ['on' => $onIconTrailing, 'off' => $offIconTrailing] : null;
    $onClick = $attributes->get('x-on:click');
    $attributes = $attributes->merge([
        'role' => 'switch',
        'aria-checked' => $checked ? 'true' : 'false',
    ]);
    $iconAttributes = [
        'on' => [
            'hidden' => !$checked ? 'hidden' : null,
            'data-when-checked' => 'show',
            'title' => $onIconTitle,
            'aria-hidden' => 'true',
        ],
        'off' => [
            'hidden' => $checked ? 'hidden' : null,
            'data-when-checked' => 'hide',
            'title' => $offIconTitle,
            'aria-hidden' => 'true',
        ],
    ];
@endphp
<x-ui::button x-ui-toggle-button
    :$icon :$iconTrailing :$iconAttributes
    :$attributes
>{{ $slot }}</x-ui::button>