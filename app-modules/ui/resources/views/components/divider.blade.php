@props([
    'horizontal' => false,
])
@php
    $attributes = as_attributes($attributes);
@endphp
<div {{ $attributes->class(['divider', 'horizontal' => $horizontal]) }}></div>