@props([
    'as' => 'div',
    'title' => null,
    'icon' => null,
    'color' => null,
    'footer' => null,
    'layer' => 1,
])
@php
    $title = as_slot($title);
    $icon = as_slot($icon);
    $body = as_slot($slot);
    $footer = as_slot($footer);
    if ($color) {
        $shades = \Filament\Support\Colors\Color::hex($color);
        foreach ($shades as $shade => $color) {
            $styles[] = "--c-{$shade}:{$color}";
        }
        $attributes = $attributes->class(['color-custom'])->style(implode(';', $styles));
    }
@endphp
@capture($transformTitle, $title)
@if($icon->attributes->isNotEmpty())
<span class="icon-wrap">
    {{ render_slot(
        $icon,
        ['component' => 'ui::icon'],
    ) }}
</span>
@endif
<span class="title">{{ $title }}</span>
@endcapture
@capture($transform, $body)
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
    @if($footer->isNotEmpty() || $footer->attributes->isNotEmpty())
    {{ render_slot(
        $footer,
        ['class' => 'footer']
    ) }}
    @endif
@endcapture
{{ render_slot(
    $body,
    $attributes->merge(['component' => 'ui::card'])->class('dialog'),
    transform: $transform
) }}