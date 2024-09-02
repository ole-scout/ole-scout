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
    if ($icon) {
        $icon = 'fluentui-' . $icon . '-' . (match($size) {
            'sm' => '16',
            default => '20',
            'lg' => '24',
        });
    }
    if ($iconTrailing) {
        $iconTrailing = 'fluentui-' . $iconTrailing . '-' . (match($size) {
            'sm' => '16',
            default => '20',
            'lg' => '24',
        });
    }
    $slotClass = $hiddenLabel ? 'sr-only' : '';
@endphp
<{{ $as }} {{ $attributes->class(
    ['label', 'label-sm' => $size === 'sm', 'label-lg' => $size === 'lg']
) }}>
@if($trailing)<span class="wrap">{{ $wrap }}</span>@endif
@if($icon) @svg($icon, ['class' => 'icon']) @endif
<span class={{ $slotClass }}>{{ $slot }}</span>
@if($iconTrailing) @svg($iconTrailing, ['class' => 'icon']) @endif
@if(!$trailing)<span class="wrap">{{ $wrap }}</span>@endif
</{{ $as }}>