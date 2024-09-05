@props([
    'icon',
    'size' => 'md',
])
@php
    if (substr($icon, 0, 1) === '/') {
        $icon = substr($icon, 1);
    } else {
        $icon = 'fluentui-' . $icon . '-' . (match($size) {
            'sm' => '16',
            default => '20',
            'lg' => '24',
        });
    }
@endphp
@svg($icon, $attributes->filter(
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
}])->all())