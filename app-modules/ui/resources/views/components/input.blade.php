@props([
    'size' => null,
    'action' => null,
    'actionTrailing' => null,
])
@php
    $action = as_slot(
        $action,
        fn($attributes) => (
            $attributes->has('component')
            ? $attributes->merge(['size' => $size])
            : $attributes
        )->class(['action'])
    );
    $actionTrailing = as_slot(
        $actionTrailing,
        fn($attributes) => (
            $attributes->has('component')
            ? $attributes->merge(['size' => $size])
            : $attributes
        )->class(['action'])
    );
@endphp
@if($attributes->get('type') === 'file')
<x-ui::file-picker {{ $attributes->merge(['size' => $size]) }} />
@else
<span {{ $attributes->only(['class'])->class(
    ['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']
) }}>
    {{ render_slot($action, ['as' => 'span']) }}
    @if($attributes->get('type') === 'textarea')
    <textarea {{ $attributes->except(['class', 'value'])->class(['input-area']) }}>{{
        $attributes->get('value')
    }}</textarea>
    @else
    <input {{ $attributes->except(['class'])->class(['input-area']) }}>
    @endif
    {{ render_slot($actionTrailing, ['as' => 'span']) }}
</span>
@endif