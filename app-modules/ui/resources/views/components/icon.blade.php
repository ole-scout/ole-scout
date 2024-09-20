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

    if (preg_match('/^\w+:/', $icon) || strpos($icon, '/') !== false) {
        $src = $icon;
        $icon = null;
    } else if (str_starts_with($icon, ':')) {
        $icon = substr($icon, 1);
        $size = match($size) {
            'xs' => '12',
            'sm' => '16',
            default => '20',
            'lg' => '24',
        };
        $i = strrpos($icon, ':');
        if ($i !== false) {
            $suffix = substr($icon, $i + 1);
            $icon = substr($icon, 0, $i);
            $icon = "fluentui-{$icon}-{$size}-{$suffix}";
        } else {
            $icon = "fluentui-{$icon}-{$size}";
        }
    }

    $hasLabel = $attributes->hasAny(['aria-label', 'aria-labelledby']);
    if ($src) {
        $attributes = $attributes->merge(['src' => $src]);
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