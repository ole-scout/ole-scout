@props([
    'size' => null,
    'wrapped' => false,
    'proxyAttributes' => [],
])
@php
    $attributes = as_attributes($attributes)->merge(
        ['type' => 'checkbox']
    );
    $proxyAttributes = as_attributes($proxyAttributes, $attributes->only(['class']))->class(
        ['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']
    );
    $attributes = $attributes->except(['class'])->class(['sr-only']);
@endphp
@if(!$wrapped)<label>@endif
    <input {{ $attributes }}>
    <span {{ $proxyAttributes }}>
        <x-ui::icon :$size icon="checkmark" class="toggle" aria-hidden="true" />
    </span>
@if(!$wrapped)</label>@endif