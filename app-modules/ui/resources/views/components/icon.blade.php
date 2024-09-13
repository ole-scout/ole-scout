@props([
    'icon',
    'src',
    'size' => 'md',
])
@php
    $attributes = as_attributes(
        $attributes,
        fn($attributes) => $attributes->merge(
            $attributes->hasAny('aria-label', 'aria-labelledby')
            ? [] : ['aria-hidden' => 'true'], false
        )->class(['icon', match($size) {
            'sm' => 'icon-sm',
            default => null,
            'lg' => 'icon-lg',
        }])
    );
@endphp
@isset($src)
{{ render_slot($slot, $attributes->merge(['src' => $src, 'as' => 'img'], false)) }}
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