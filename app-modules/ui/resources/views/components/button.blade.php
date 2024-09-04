@props([
    'as' => null,
    'disabled' => false,
    'size' => 'md',
    'intent' => null,
    'variant' => null,
    'icon' => null,
    'iconTrailing' => null,
    'iconAttributes' => [],
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
    if ($as) {
        $attributes = $attributes->class(
            [...$classes, 'disabled' => $disabled]
        );
    } else if (!$attributes->has('href')) {
        $as = 'button';
        $attributes = $attributes->class($classes)->merge([
            'disabled' => $disabled,
            'type' => $attributes->get('type') ?: 'button',
        ]);
    } else if (!$disabled) {
        $as = 'a';
        $attributes =$attributes->class(
            [...$classes, 'disabled' => $disabled]
        );
    } else {
        $as = 'span';
        $attributes = $attributes->filter(
            fn (string $value, string $key) => !in_array($key, $linkProps)
        )->class(
            [...$classes, 'disabled' => $disabled]
        );
    }
    if (!is_array($icon)) $icon = $icon ? [$icon] : [];
    if (!is_array($iconTrailing)) $iconTrailing = $iconTrailing ? [$iconTrailing] : [];
@endphp
<{{ $as }} {{ $attributes }}>
    @foreach($icon as $key => $iconName)
    <x-ui::icon :$size :icon="$iconName" :attributes="$attributes->only([])->merge(
            is_string($key) ? Arr::get($iconAttributes, $key, []) : []
        )" />
    @endforeach
    @if(trim($slot)) <span class="{{ $slotClass }}">{{ $slot }}</span> @endif
    @foreach($iconTrailing as $key => $iconName)
    <x-ui::icon :$size :icon="$iconName" :attributes="$attributes->only([])->merge(
            is_string($key) ? Arr::get($iconAttributes, $key, []) : []
        )" />
    @endforeach
</{{ $as }}>