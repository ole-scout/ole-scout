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
    $as = $fake ? 'span' : 'label';
    $wrapAttributes = (
        isset($wrap->attributes)
        ? $wrap->attributes->get('attributes') ?: $wrap->attributes
        : $attributes->only([])
    );
@endphp
<{{ $as }} {{ $attributes->class(
    ['label', 'label-sm' => $size === 'sm', 'label-lg' => $size === 'lg']
) }}>
    @if($trailing && trim($wrap))
    <span {{ $wrapAttributes->class(['wrap']) }}>{{ $wrap }}</span>
    @endif
    @if($icon)
    <x-ui::icon :$size :icon="$icon" />
    @endif
    <span class={{ $hiddenLabel ? 'sr-only' : '' }}>{{ $slot }}</span>
    @if($iconTrailing)
    <x-ui::icon :$size :icon="$iconTrailing" />
    @endif
    @if(!$trailing && trim($wrap))
    <span {{ $wrapAttributes->class(['wrap']) }}>{{ $wrap }}</span>
    @endif
</{{ $as }}>