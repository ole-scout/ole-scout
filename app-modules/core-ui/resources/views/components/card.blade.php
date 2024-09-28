@props([
    'icon' => 'icon-ole-scout',
    'actions' => null,
    'title',
    'color',
    'count',
    'slug',
])
@php
    $actions = as_slot($actions);
    $slot = as_slot($slot);
    if (isset($color)) {
        $shades = \Filament\Support\Colors\Color::hex($color);
        foreach ($shades as $shade => $color) {
            $styles[] = "--c-{$shade}:{$color}";
        }
        $style = implode(';', $styles);
    } else {
        $style = null;
    }
@endphp
<x-ui::card :layer="3" class="core__card" :$style>
    <div class="header">
        <div class="icon-wrap"><x-ui::icon :icon="$icon" /></div>
        @isset($count)
        <div class="count-wrap"><div class="count">{{ $count }}</div></div>
        @endisset
    </div>
    @isset($slug)
    <div class="slug">{{ $slug }}</div>
    @endisset
    <div class="title">{{ $title }}</div>
    <div class="body">
        {{ render_slot($slot) }}
    </div>
    @if($actions->isNotEmpty())
    {{ render_slot($actions, ['class' => 'actions']) }}
    @endif
</x-ui::card>