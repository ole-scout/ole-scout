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
    )->class(['wrap']);
    if ($wrapAttributes->has('component')) {
        $wrapComponent = $wrapAttributes->get('component');
        $wrapAttributes = $wrapAttributes->except('component')->merge(['size' => $size]);
        if (in_array($wrapComponent, ['ui::checkbox', 'ui::radio', 'ui::switch'])) {
            $wrapAttributes = $wrapAttributes->merge(['wrapped' => true]);
        }
    }
@endphp
<{{ $as }} {{ $attributes->class(
    ['label', 'label-sm' => $size === 'sm', 'label-lg' => $size === 'lg']
) }}>
    @if($trailing)
    @isset($wrapComponent)
    <x-dynamic-component
        :component="$wrapComponent"
        :attributes="$wrapAttributes"
    >{{ $wrap }}</x-dynamic-component>
    @else
    @if($wrap)<span {{ $wrapAttributes }}>{{ $wrap }}</span>@endif
    @endisset
    @endif
    @if($icon)<x-ui::icon :$size :$icon />@endif
    <span class={{ $hiddenLabel ? 'sr-only' : '' }}>{{ $slot }}</span>
    @if($iconTrailing)<x-ui::icon :$size :icon="$iconTrailing" />@endif
    @if(!$trailing)
    @isset($wrapComponent)
    <x-dynamic-component
        :component="$wrapComponent"
        :attributes="$wrapAttributes"
    >{{ $wrap }}</x-dynamic-component>
    @else
    @if($wrap)<span {{ $wrapAttributes }}>{{ $wrap }}</span>@endif
    @endisset
    @endif
</{{ $as }}>