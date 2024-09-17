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
        'input-radio',
    ]);
    $inputAttributes = $attributes->except('class')->merge([
        'type' => 'radio',
        'class' => 'sr-only',
    ]);
@endphp
@capture($transform, $contents)
{{ $contents }}
<input {{ $inputAttributes }}>
<span class="toggle"></span>
@endcapture
{{ render_slot(
    $slot,
    transform: $transform,
    fallbackTag: 'label'
) }}