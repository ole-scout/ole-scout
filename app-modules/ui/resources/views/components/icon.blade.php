@props([
    'icon',
    'size' => 'md',
])
@php
    $icon = 'fluentui-' . $icon . '-' . (match($size) {
        'sm' => '16',
        default => '20',
        'lg' => '24',
    });
@endphp
@svg($icon, $attributes->filter(
    fn ($value) => $value !== null && $value !== false
)->class(['icon', match($size) {
    'sm' => 'icon-sm',
    default => null,
    'lg' => 'icon-lg',
}])->all())