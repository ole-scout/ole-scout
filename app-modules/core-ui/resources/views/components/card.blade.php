@props([
    'icon' => 'icon-ole-scout',
    'actions' => null,
    'flag' => null,
    'title',
    'footer',
    'color',
    'count',
    'slot',
    'slug',
])
@php
    $attributes = as_attributes($attributes);
    $actions = as_slot($actions);
    $flag = as_slot($flag);
    $slot = as_slot($slot);
    if (isset($color)) {
        $shades = \Filament\Support\Colors\Color::hex($color);
        foreach ($shades as $shade => $color) {
            $styles[] = "--c-{$shade}:{$color}";
        }
        $attributes = $attributes->style($styles);
    }
@endphp
<x-ui::card :layer="3" class="core__card" :$attributes>
    <div class="header">
        @if(str_contains($attributes->get('style'), '--background-image'))
        <div class="image"></div>
        @endif
        <div class="icon-wrap"><x-ui::icon :icon="$icon" /></div>
        @isset($count)
        <div class="count-wrap"><div class="count">{{ $count }}</div></div>
        @endisset
        @if($flag->isNotEmpty())
        {{ render_slot($flag, ['class' => 'flag']) }}
        @endif
    </div>
    @isset($slug)
    <div class="slug">{{ $slug }}</div>
    @endisset
    <div class="title">{{ $title }}</div>
    {{ render_slot($slot, ['class' => 'body']) }}
    @isset($footer)
    <div class="core__card_footer" aria-hidden="true">
    <x-ui::icon :icon="$icon" />
    </div>
    @endisset
    @if($actions->isNotEmpty())
    {{ render_slot($actions, ['class' => 'actions']) }}
    @endif
</x-ui::card>