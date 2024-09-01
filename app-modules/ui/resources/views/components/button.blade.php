@props([
    'disabled' => false,
    'small' => false,
    'intent' => null,
    'variant' => null,
])
@php
    if (!$intent) {
        $isSubmit = $attributes->has('type') && $attributes->get('type') === 'submit';
        $intent = $isSubmit ? 'primary' : 'default';
    }
    if ($variant === 'disabled') {
        $variant = null;
        $disabled = true;
    }
    if (!$variant) {
        $variant = $attributes->has('href') ? 'link' : 'normal';
    }
    $linkProps = ['href', 'target', 'rel'];
@endphp
@if(!$attributes->has('href'))
<button {{ $attributes->merge([
        'class' => \FossHaas\Ui\buttonStyles(
            intent: $intent,
            variant: $variant,
            disabled: $disabled,
            small: $small,
        ),
        'disabled' => $disabled,
        'type' => $attributes->get('type') ?: 'button',
    ]
) }}>{{ $slot }}</button>
@elseif(!$disabled)
<a {{ $attributes-merge([
    'class' => \FossHaas\Ui\buttonStyles(
        intent: $intent,
        variant: $variant,
        disabled: false,
        small: $small,
    )
]) }}>{{ $slot }}</a>
@else
<span {{ $attributes->filter(
    fn (string $value, string $key) => !in_array($key, $linkProps)
)->merge([
    'class' => \FossHaas\Ui\buttonStyles(
        intent: $intent,
        variant: $variant,
        disabled: true,
        small: $small,
    )
]) }}>{{ $slot }}</span>
@endif