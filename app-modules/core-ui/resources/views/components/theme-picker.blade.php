@props([
    'name' => 'theme',
    'value' => null,
    'iconLight' => ':weather-sunny',
    'iconDark' => ':weather-moon',
    'iconSystem' => ':desktop',
    'labelLight' => __('Hell'),
    'labelDark' => __('Dunkel'),
    'labelSystem' => __('System'),
    'showLabels' => false,
])
<x-ui::toggle-group x-core-ui-theme-picker :$attributes
    :$name :$value :hiddenLabel="!$showLabels" :options="[
        ['label' => $labelLight, 'icon' => $iconLight, 'value' => 'light'],
        ['label' => $labelDark, 'icon' => $iconDark, 'value' => 'dark'],
        ['label' => $labelSystem, 'icon' => $iconSystem, 'value' => 'system'],
    ]"
/>