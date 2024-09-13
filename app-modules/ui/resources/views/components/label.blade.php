@props([
    'size' => 'md',
    'fake' => false,
    'trailing' => false,
    'wrap' => null,
    'icon' => null,
    'iconTrailing' => null,
    'hiddenLabel' => false,
])
@php
    $wrappedComponents = ['ui::checkbox', 'ui::radio', 'ui::switch'];
    $wrap = as_slot(
        $wrap,
        fn($attributes) => (
            $attributes->has('component')
            ? (
                in_array($attributes->get('component'), $wrappedComponents)
                ? $attributes->merge(['wrapped' => true])
                : $attributes
            )->merge(['size' => $size])
            : $attributes->merge(['as' => 'span'])
        )->class(['wrap'])
    );
@endphp
@capture($wrapper, $slot)
    @if($trailing)
    {{ render_slot($wrap) }}
    @endif
    @if($icon)<x-ui::icon :$size :$icon />@endif
    <span class={{ $hiddenLabel ? 'sr-only' : '' }}>{{ $slot }}</span>
    @if($iconTrailing)<x-ui::icon :$size :icon="$iconTrailing" />@endif
    @if(!$trailing)
    {{ render_slot($wrap) }}
    @endif
@endcapture
{{ render_slot($wrapper($slot), $attributes
    ->merge(['as' => $fake ? 'span' : 'label'])
    ->class(['label', 'label-sm' => $size === 'sm', 'label-lg' => $size === 'lg'])
) }}