@props([
    'as' => 'div',
    'title' => null,
    'icon' => null,
    'footer' => null,
    'layer' => 1,
])
@php
    $title = as_slot($title);
    $icon = as_slot($icon);
    $body = as_slot($slot);
    $footer = as_slot($footer);
    $circle = $icon->attributes->get('circle') ?? false;
    $icon->attributes = $icon->attributes->except('circle');
@endphp
<{{ $as }} {{ $attributes->class([
    match ($layer) {
        default => 'card',
        2 => 'card-2',
        3 => 'card-3',
    }
]) }}>
    @capture($transformTitle, $title)
    @if($icon->isNotEmpty())
    <span class="icon-wrap">{{ render_slot($icon, [
        'component' => 'ui::icon',
        'aria-hidden' => 'true',
        'class' => $circle ? 'circle' : null,
    ]) }}</span>
    @endif
    <span class="title">{{ $title }}</span>
    @endcapture
    @if($title->isNotEmpty())
    {{ render_slot(
        $title,
        ['class' => 'header'],
        transform: $transformTitle,
    ) }}
    @endif
    {{ render_slot(
        $body,
        ['class' => 'body']
    ) }}
    @if($footer->isNotEmpty())
    {{ render_slot(
        $footer,
        ['class' => 'footer']
    ) }}
    @endif
</{{ $as }}>