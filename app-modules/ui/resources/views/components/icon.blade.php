@props([
    'icon',
    'src',
    'size' => 'md',
])
@php
    if ($attributes->has('attributes')) {
        $attributes = $attributes->except([
            'attributes',
        ])->merge($attributes->get('attributes'));
    }
    $attributes = $attributes->filter(
        fn ($value) => $value !== null && $value !== false
    )->merge(
        $attributes->hasAny('aria-label', 'aria-labelledby') ? [
        ] : [
            'aria-hidden' => 'true',
        ]
    )->class(['icon', match($size) {
        'sm' => 'icon-sm',
        default => null,
        'lg' => 'icon-lg',
    }]);
@endphp
@isset($src)
<img {{ $attributes->merge(['src' => $src]) }}>
@else
@svg(
    substr($icon, 0, 1) === '/'
    ? substr($icon, 1)
    : 'fluentui-' . $icon . '-' . (match($size) {
            'sm' => '16',
            default => '20',
            'lg' => '24',
    }),
    $attributes->all()
)
@endisset