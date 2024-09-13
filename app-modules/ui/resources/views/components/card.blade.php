@props([
    'as' => 'div',
    'title' => null,
    'body' => null,
    'icon' => null,
    'layer' => 1,
])
@php
    $iconAttributes = as_attributes($icon, fn($attributes) => $attributes
        ->except(['circle'])
        ->merge(['aria-hidden' => 'true'])
        ->class(['circle' => $attributes->has('circle')]));
    $title = as_slot($title);
    $body = as_slot($body);
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
    as_attributes(['as' => 'div'])->class(['title'])
) }}
{{ render_slot($slot->isEmpty() ? $body->toHtml() : $slot, as_attributes(as_slot($body)->attributes->class('body'), ['as' => 'div']), allowEmpty: true) }}
</{{ $as }}>