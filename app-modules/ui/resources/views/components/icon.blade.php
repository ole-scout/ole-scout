@props([
    'src',
    'size' => 'md',
])
@php
    $attributes = as_attributes(
        $attributes,
    )->class(['icon', match($size) {
        'sm' => 'icon-sm',
        default => null,
        'lg' => 'icon-lg',
    }]);
    $hasLabel = $attributes->hasAny(['aria-label', 'aria-labelledby']);
    if (!$hasLabel && (!isset($src) || !$atributes->has('alt'))) {
        $attributes = $attributes->merge(['aria-hidden' => 'true']);
    }
@endphp
@isset($src)
{{ render_slot(
    $slot,
    $attributes->merge(['src' => $src]),
    fallbackTag: 'img'
) }}
@else
@php
    $slot = (string) $slot;
    $icon = substr($slot, 0, 1) === '/'
        ? substr($slot, 1)
        : 'fluentui-' . $slot . '-' . (match($size) {
            'sm' => '16',
            default => '20',
            'lg' => '24',
        });
@endphp
@svg($icon, $attributes->all())
@endisset