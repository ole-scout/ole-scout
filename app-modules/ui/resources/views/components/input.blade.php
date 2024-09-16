@props([
    'size' => null,
    'action' => null,
    'actionTrailing' => null,
])
@php
    $action = as_slot($action);
    if ($action->attributes->has('component')) {
        $action->attributes = $action->attributes->merge([
            'size' => $size,
        ]);
    }
    $actionTrailing = as_slot($actionTrailing);
    if ($actionTrailing->attributes->has('component')) {
        $actionTrailing->attributes = $actionTrailing->attributes->merge([
            'size' => $size,
        ]);
    }
@endphp
@if($attributes->get('type') === 'file')
<x-ui::file-picker :attributes="$attributes->merge(['size' => $size])" />
@else
<span {{ $attributes->only(['class'])->class(
    ['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']
) }}>
    @if($action->isNotEmpty())
    {{ render_slot($action, ['class' => 'action'], fallbackTag: 'span') }}
    @endif
    @if($attributes->get('type') === 'textarea')
    {{ render_slot($attributes->get('value'), $attributes->except(['class', 'value'])->class(['input-area']), fallbackTag: 'textarea') }}
    @else
    <input {{ $attributes->except('class')->class(['input-area']) }}>
    @endif
    @if($actionTrailing->isNotEmpty())
    {{ render_slot($actionTrailing, ['class' => 'action'], fallbackTag: 'span') }}
    @endif
</span>
@endif