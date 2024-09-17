@props([
    'icon',
    'size' => null,
])
@php
    $label = trim((string) $slot);
    if (!isset($icon)) {
        $icon = $label;
        $label = '';
    }
    $src = null;
    $icon = (string) $icon;
    $attributes = as_attributes($attributes)->class([
        'icon',
        'icon-sm' => $size === 'sm' || $size === 'xs',
        'icon-lg' => $size === 'lg',
    ]);

    if (str_starts_with($icon, 'data:')) {
        $src = $icon;
        $icon = null;
    } else if (str_starts_with($icon, ':')) {
        $icon = substr($icon, 1);
        $suffix = match($size) {
            'xs' => '12',
            'sm' => '16',
            default => '20',
            'lg' => '24',
        };
        $icon = "fluentui-{$icon}-{$suffix}";
    }

    $hasLabel = $attributes->hasAny(['aria-label', 'aria-labelledby']);
    if ($src) {
        $attributes = $attributes->merge(['src', $src]);
        if ($label) {
            $attributes = $attributes->merge(['alt' => $slot]);
            $hasLabel = true;
        } else {
            $hasLabel = $hasLabel || !empty($attributes->get('alt'));
            $attributes = $attributes->merge(['alt' => '']);
        }
    } else if ($label) {
        $attributes = $attributes->merge(['aria-label', $label]);
        $hasLabel = true;
    }
    if (!$hasLabel) {
        $attributes = $attributes->merge(['aria-hidden' => 'true']);
    }
@endphp
@if($src)
<img {{ $attributes }}>
@else
@svg($icon, $attributes->all())
@endif