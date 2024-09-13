@props([
    'as' => 'div',
    'title' => null,
    'icon' => null,
    'layer' => 1,
])
@php
    $iconAttributes = as_attributes($icon);
    $iconAttributes = $iconAttributes
        ->except(['circle'])
        ->merge(['aria-hidden' => 'true'], false)
        ->class(['circle' => $iconAttributes->has('circle')]);
    $title = as_slot($title);
@endphp
<{{ $as }} {{ $attributes->class([
    match ($layer) {
        default => 'card',
        2 => 'card-2',
        3 => 'card-3',
    }
]) }}>
@capture($wrapper,$slot)
@if($icon)<span class="icon-wrap"><x-ui::icon :$icon :attributes="$iconAttributes" /></span>@endif
<span class="title-wrap">{{ $slot }}</span>
@endcapture
{{ render_slot(
    $wrapper($title->toHtml()),
    $title->attributes->merge(['as' => 'div'], false)->class(['title'])
) }}
<div class="body">{{ $slot }}</div>
</{{ $as }}>