@props([
    'progress' => 0,
    'size' => null,
])
@php
    $attributes = as_attributes($attributes);
    $slot = as_slot($slot);
@endphp
@capture($transform, $contents)
<div class="bar" aria-hidden="true" title="{{ $progress }} %">
    <div class="fill" style="width: {{ $progress }}%"></div>
</div>
<progress {{ $slot->attributes->merge([
    'value' => $progress,
    'max' => '100'
])->class('sr-only') }}>{{ $progress }} %</progress>
@endcapture
{{ render_slot(
    $slot->toHtml(),
    $attributes->class([
        'progress',
        'full' => $progress === 100,
        match($size) {
            'sm' => 'progress-sm',
            default => null,
            'lg' => 'progress-lg',
        }
    ]),
    transform: $transform,
    fallbackTag: 'div'
) }}