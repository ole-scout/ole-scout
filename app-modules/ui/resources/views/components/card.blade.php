@props([
    'as' => 'div',
    'title' => null,
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
>{{ $title }}</x-dynamic-component>
@else
<div class="title">{{ $title }}</div>
@endisset
<div class="body">{{ $slot }}</div>
@else
{{ $slot }}
@endif
</{{ $as }}>