@props([
    'as' => 'label',
    'size' => 'md',
    'trailing' => false,
    'icon' => null,
    'iconTrailing' => null,
    'hiddenLabel' => false,
])
@php
    $attributes = as_attributes($attributes);
    $slot = as_slot($slot);
    $icon = as_slot($icon);
    $iconTrailing = as_slot($iconTrailing);
@endphp
@capture($transform, $contents)
    @if($icon->isNotEmpty())
    {{ render_slot($icon, ['component' => 'ui::icon', 'size' => $size]) }}
    @endif
    {{ render_slot(
        as_slot($contents, $slot->attributes),
        $hiddenLabel ? ['class' => 'sr-only'] : null,
        fallbackTag: 'span',
    ) }}
    @if($iconTrailing->isNotEmpty())
    {{ render_slot($iconTrailing, ['component' => 'ui::icon', 'size' => $size]) }}
    @endif
@endcapture
{{ render_slot(
    $slot->toHtml(),
    $attributes->class([
        'label',
        'label-sm' => $size === 'sm',
        'label-lg' => $size === 'lg',
    ]),
    transform: $transform,
    fallbackTag: $as,
) }}