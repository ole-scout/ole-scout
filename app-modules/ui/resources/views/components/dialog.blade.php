@props([
    'as' => 'div',
    'title' => null,
    'header' => null,
    'icon' => null,
    'color' => null,
    'footer' => null,
    'layer' => 1,
])
@php
    $attributes = as_attributes($attributes);
    $title = as_slot($title);
    $header = as_slot($header);
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
@capture($transformHeader, $contents)
@if($icon->attributes->isNotEmpty())
<span class="icon-wrap">
    {{ render_slot(
        $icon,
        ['component' => 'ui::icon'],
    ) }}
</span>
@endif
{{ render_slot($title, ['class' => 'title'], fallbackTag: 'span') }}
@endcapture
@capture($transform, $contents)
    @if($title->isNotEmpty())
    {{ render_slot(
        $header,
        ['class' => 'header'],
        transform: $transformHeader,
    ) }}
    @endif
    {{ render_slot(
        $contents,
        $body->attributes->class('body')
    ) }}
    @if($footer->isNotEmpty() || $footer->attributes->isNotEmpty())
    {{ render_slot(
        $footer,
        ['class' => 'footer']
    ) }}
    @endif
@endcapture
{{ render_slot(
    $body->toHtml(),
    $attributes->merge(['component' => 'ui::card'])->class('dialog'),
    transform: $transform
) }}