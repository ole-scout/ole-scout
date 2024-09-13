@props([
    'size' => null,
    'wrapped' => false,
    'proxyAttributes' => [],
])
@php
    $attributes = as_attributes($attributes)->merge(
        ['type' => 'radio'], false
    );
    $proxyAttributes = as_attributes($proxyAttributes, $attributes->only(['class']))->class(
        ['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']
    );
    $attributes = $attributes->except(['class'])->class(['sr-only']);
@endphp
@if(!$wrapped)<label>@endif
    <input {{ $attributes }}>
    <span {{ $proxyAttributes }}><span class="toggle"></span></span>
@if(!$wrapped)</label>@endif