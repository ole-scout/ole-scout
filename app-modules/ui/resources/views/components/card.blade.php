@props([
    'as' => 'div',
    'title' => null,
    'icon' => null,
    'layer' => 1,
])
@php
    $titleAttributes = (
        isset($title->attributes)
        ? $title->attributes->get('attributes') ?: $title->attributes
        : $attributes->only([])
    )->class(['title']);
    if ($titleAttributes->has('component')) {
        $titleComponent = $titleAttributes->get('component');
        $titleAttributes = $titleAttributes->except('component');
    }
    $iconAttributes = (
        isset($icon->attributes)
        ? $icon->attributes->get('attributes') ?: $icon->attributes
        : $attributes->only([])
    );
    $iconAttributes = $iconAttributes->except(['circle'])->merge([
        'aria-hidden' => 'true',
    ])->class(['circle' => $iconAttributes->has('circle')]);
@endphp
<{{ $as }} {{ $attributes->class([
    match ($layer) {
        default => 'card',
        2 => 'card-2',
        3 => 'card-3',
    }
]) }}>
@if($title)
@isset($titleComponent)
<x-dynamic-component
    :component="$titleComponent"
    :attributes="$titleAttributes"
>
@if($icon)<span class="icon-wrap"><x-ui::icon :$icon :attributes="$iconAttributes" /></span>@endif
<span class="title-wrap">{{ $title }}</span>
</x-dynamic-component>
@else
<div class="title">
@if($icon)<span class="icon-wrap"><x-ui::icon :$icon :attributes="$iconAttributes" /></span>@endif
<span class="title-wrap">{{ $title }}</span>
</div>
@endisset
<div class="body">{{ $slot }}</div>
@else
{{ $slot }}
@endif
</{{ $as }}>