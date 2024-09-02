@props([
    'as' => null,
    'disabled' => false,
    'size' => 'md',
    'intent' => null,
    'variant' => null,
    'icon' => null,
    'iconTrailing' => null,
    'hiddenLabel' => false,
])
@php
    if (!$intent) {
        $isSubmit = $attributes->has('type') && $attributes->get('type') === 'submit';
        $intent = $isSubmit ? 'primary' : 'normal';
    }
    if (!$variant && $attributes->has('href')) {
        $variant = 'link';
    }
    if ($icon) $icon = 'fluentui-' . $icon . '-' . (match($size) {
        'sm' => '16',
        default => '20',
        'lg' => '24',
    });
    if ($iconTrailing) $iconTrailing = 'fluentui-' . $iconTrailing . '-' . (match($size) {
        'sm' => '16',
        default => '20',
        'lg' => '24',
    });
    $slotClass = $hiddenLabel ? 'sr-only' : '';
    $classes = ['btn', 'btn-sm' => $size === 'sm', 'btn-lg' => $size === 'lg'];
    $classes[] = match ($variant) {
        'alt' => 'btn-alt',
        'ghost' => 'btn-ghost',
        'overlay' => 'btn-overlay',
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
@if($as)
<{{ $as }} {{ $attributes->class(
    [...$classes, 'disabled' => $disabled]
) }}>
    @if($icon) @svg($icon, ['class' => 'icon']) @endif
    @if(trim($slot)) <span class="{{ $slotClass }}">{{ $slot }}</span> @endif
    @if($iconTrailing) @svg($iconTrailing, ['class' => 'icon']) @endif
</{{ $as }}>
@elseif(!$attributes->has('href'))
<button {{ $attributes->class($classes)->merge([
        'disabled' => $disabled,
        'type' => $attributes->get('type') ?: 'button',
    ]
) }}>
    @if($icon) @svg($icon, ['class' => 'icon']) @endif
    @if(trim($slot)) <span class="{{ $slotClass }}">{{ $slot }}</span> @endif
    @if($iconTrailing) @svg($iconTrailing, ['class' => 'icon']) @endif
</button>
@elseif(!$disabled)
<a {{ $attributes->class(
    [...$classes, 'disabled' => $disabled]
) }}>
    @if($icon) @svg($icon, ['class' => 'icon']) @endif
    @if(trim($slot)) <span class="{{ $slotClass }}">{{ $slot }}</span> @endif
    @if($iconTrailing) @svg($iconTrailing, ['class' => 'icon']) @endif
</a>
@else
<span {{ $attributes->filter(
    fn (string $value, string $key) => !in_array($key, $linkProps)
)->class(
    [...$classes, 'disabled' => $disabled]
) }}>
    @if($icon) @svg($icon, ['class' => 'icon']) @endif
    @if(trim($slot)) <span class="{{ $slotClass }}">{{ $slot }}</span> @endif
    @if($iconTrailing) @svg($iconTrailing, ['class' => 'icon']) @endif
</span>
@endif