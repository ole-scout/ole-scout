@use(Illuminate\Support\Arr)
@props([
    'disabled' => false,
    'size' => 'md',
    'intent' => null,
    'variant' => null,
    'icon' => null,
    'iconTrailing' => null,
    'hiddenLabel' => false,
])
@php
    $attributes = as_attributes($attributes);
    $slot = as_slot($slot);
    $iconLeading = Arr::map(
        Arr::wrap($icon) ?? [],
        fn($icon) => as_slot($icon, [
            'component' => 'ui::icon',
            'size' => $size,
        ])
    );
    $iconTrailing = Arr::map(
        Arr::wrap($iconTrailing) ?? [],
        fn($icon) => as_slot($icon, [
            'component' => 'ui::icon',
            'size' => $size,
        ])
    );
    if (!$intent) {
        $isSubmit = $attributes->has('type') && $attributes->get('type') === 'submit';
        $intent = $isSubmit ? 'primary' : 'normal';
    }
    if (!$variant && $attributes->has('href')) {
        $variant = 'link';
    }
    $classes = ['btn', 'btn-sm' => $size === 'sm', 'btn-lg' => $size === 'lg'];
    $classes[] = match ($variant) {
        'neutral' => null,
        'alt' => 'btn-alt',
        'ghost' => 'btn-ghost',
        'overlay' => 'btn-overlay',
        'link' => 'btn-link',
        default => 'btn-button',
    };
    if ($variant !== 'neutral') {
        $classes[] = match($intent) {
            'primary' => 'btn-primary',
            'danger' => 'btn-danger',
            'success' => 'btn-success',
            default => 'btn-normal',
        };
    }
    if ($attributes->has('x-ui-busy')) {
        $iconTrailing[] = as_slot('', [
            'component' => 'ui::icon',
            'icon' => 'fluentui-spinner-ios-20',
            'class' => 'animate-spin busy-icon',
        ]);
    }

    $linkProps = ['href', 'target', 'rel'];
    $fallbackTag = 'button';
    if ($attributes->has('as')) {
        $attributes = $attributes->class(
            [...$classes, 'disabled' => $disabled]
        );
    } else if (!$attributes->has('href')) {
        $attributes = $attributes->merge([
            'disabled' => $disabled,
            'type' => $attributes->get('type') ?: 'button',
        ])->class($classes);
    } else if (!$disabled) {
        $fallbackTag = 'a';
        $href = $attributes->get('href');
        $attributes = $attributes->except(['href'])->merge(
            is_external_url($href) ? [
                'href' => $href,
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
            ] : [
                'href' => is_relative_url($href) ? url($href) : $href,
                'wire:navigate'
            ]
        )->class(
            [...$classes, 'disabled' => $disabled]
        );
    } else {
        $fallbackTag = 'span';
        $attributes = $attributes->filter(
            fn (string $value, string $key) => !in_array($key, $linkProps)
        )->class(
            [...$classes, 'disabled' => $disabled]
        );
    }
@endphp
@capture($transform, $contents)
    @foreach($iconLeading as $icon)
    {{ render_slot($icon) }}
    @endforeach
    {{ render_slot(
        $contents,
        [
            'size' => $attributes->has('component') ? $size : null,
            'class' => $hiddenLabel ? 'sr-only' : null,
        ]
    ) }}
    @foreach($iconTrailing as $icon)
    {{ render_slot($icon) }}
    @endforeach
@endcapture
{{ render_slot(
    $slot,
    $attributes,
    transform: $transform,
    fallbackTag: $fallbackTag,
) }}