@props([
    'disabled' => false,
    'small' => false,
    'intent' => null,
    'variant' => null,
])
@php
    if (!$intent) {
        $isSubmit = $attributes->has('type') && $attributes->get('type') === 'submit';
        $intent = $isSubmit ? 'primary' : 'normal';
    }
    if (!$variant && $attributes->has('href')) {
        $variant = 'link';
    }
    $classes = ['btn', 'btn-sm' => $small];
    $classes[] = match ($variant) {
        'alt' => 'btn-alt',
        'ghost' => 'btn-ghost',
        'link' => 'btn-link',
        default => null,
    };
    if ($variant !== 'neutral') {
        $classes[] = match($intent) {
            'primary' => 'btn-primary',
            'danger' => 'btn-danger',
            'success' => 'btn-success',
            default => 'btn-normal',
        };
    }

    $linkProps = ['href', 'target', 'rel'];
@endphp
@if(!$attributes->has('href'))
<button {{ $attributes->class($classes)->merge([
        'disabled' => $disabled,
        'type' => $attributes->get('type') ?: 'button',
    ]
) }}>{{ $slot }}</button>
@elseif(!$disabled)
<a {{ $attributes->class(
    [...$classes, 'disabled' => $disabled]
) }}>{{ $slot }}</a>
@else
<span {{ $attributes->filter(
    fn (string $value, string $key) => !in_array($key, $linkProps)
)->class(
    [...$classes, 'disabled' => $disabled]
) }}>{{ $slot }}</span>
@endif