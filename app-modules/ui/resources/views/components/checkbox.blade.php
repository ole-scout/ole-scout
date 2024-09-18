@props([
    'size' => null,
])
@php
    $attributes = as_attributes($attributes);
    $slot = as_slot($slot);
    $slot->attributes = $slot->attributes->merge([
        'class' => $attributes->get('class')
    ])->class([
        'input',
        'input-sm' => $size === 'sm',
        'input-lg' => $size === 'lg',
        'input-checkbox',
    ]);
    $inputAttributes = $attributes->except('class')->merge([
        'type' => 'checkbox',
        'class' => 'sr-only',
    ]);
@endphp
@capture($transform, $contents)
<input {{ $inputAttributes->merge(['value' => (string) $contents]) }}>
<x-ui::icon size="xs" class="toggle" icon=":checkmark"></x-ui::icon>
<x-ui::icon size="xs" class="indeterminate" icon="heroicon-s-minus"></x-ui::icon>
@endcapture
{{ render_slot(
    $slot,
    transform: $transform,
    fallbackTag: 'label'
) }}