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
    $slotAttributes = (
        isset($slot->attributes)
        ? $slot->attributes->get('attributes') ?: $slot->attributes
        : $attributes->only([])
    )->class(['sr-only' => $hiddenLabel]);
    if ($slotAttributes->has('component')) {
        $slotComponent = $slotAttributes->get('component');
        $slotAttributes = $slotAttributes->except('component')->merge(['size' => $size]);
    }
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
        $attributes = $attributes->merge([
            'disabled' => $disabled,
            'type' => $attributes->get('type') ?: 'button',
        ])->class($classes);
    } else if (!$disabled) {
        $as = 'a';
        $href = $attributes->get('href');
        $attributes = $attributes->except(['href'])->merge(
            substr($href, 0, 1) === '/' ? [
                'href' => url($href),
            ] : [
                'href' => $href,
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
            ]
        )->class(
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
    @if(isset($slotComponent))
    <x-dynamic-component
        :component="$slotComponent"
        :attributes="$slotAttributes"
    >{{ $slot }}</x-dynamic-component>
    @else
    @if(trim($slot))<span {{ $slotAttributes }}>{{ $slot }}</span>@endif
    @endif
    @foreach($iconTrailing as $key => $iconName)
    <x-ui::icon :$size :icon="$iconName" :attributes="$attributes->only([])->merge(
        is_string($key) ? Arr::get($iconAttributes, $key, []) : []
    )" />
    @endforeach
</{{ $as }}>