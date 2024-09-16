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
        'input-lg' => $size === 'lg'
    ]);
    $inputAttributes = $attributes->except('class')->merge([
        'type' => 'checkbox',
        'class' => 'sr-only'
    ]);
@endphp
@capture($transform, $contents)
<input {{ $inputAttributes->merge(['value' => (string) $contents]) }}>
<x-ui::icon :$size class="toggle" aria-hidden="true">checkmark</x-ui::icon>
@endcapture
{{ render_slot(
    $slot,
    transform: $transform,
    fallbackTag: 'label'
) }}