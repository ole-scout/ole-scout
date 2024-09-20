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
        'input-switch',
    ]);
    $inputAttributes = $attributes->except('class')->merge([
        'type' => 'checkbox',
        'role' => 'switch',
        'class' => 'sr-only',
    ]);
@endphp
@capture($transform, $contents)
{{ $contents }}
<input {{ $inputAttributes->merge(['value' => 'true']) }}>
<span class="toggle"></span>
@endcapture
{{ render_slot(
    $slot,
    transform: $transform,
    fallbackTag: 'label'
) }}