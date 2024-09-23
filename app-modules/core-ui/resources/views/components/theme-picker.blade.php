@props([
    'name' => 'theme',
    'showLabels' => false,
])
@php
    $attributes = as_attributes($attributes);
    $options = [
        'light' => ['icon' => ':weather-sunny', 'label' => __('Light')],
        'dark' => ['icon' => ':weather-moon', 'label' => __('Dark')],
        'system' => ['icon' => ':desktop', 'label' => __('System')],
    ];
@endphp
<x-ui::toggle-group x-data="core_ui_theme_picker()" :$attributes>
    @foreach($options as $value => $option)
    <x-ui::toggle-group.button
        :$name :$value
        :icon="$option['icon']"
        :hiddenLabel="!$showLabels"
    >{{ $option['label'] }}</x-ui::toggle-group.button>
    @endforeach
</x-ui::toggle-group>