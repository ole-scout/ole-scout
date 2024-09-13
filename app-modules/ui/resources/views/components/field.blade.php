@props([
    'id',
    'label' => null,
    'hint' => null,
    'description' => null,
    'error' => null,
    'size' => null,
    'action' => null,
    'actionTrailing' => null,
    'extra' => [],
])
@php
    $input = as_slot('', as_attributes($attributes)->merge([
        'component' => 'ui::input',
        'id' => $id,
        'action' => $action,
        'actionTrailing' => $actionTrailing,
        'aria-labelledby' => $id . '-label',
        'aria-describedby' => $id . '-description',
        'size' => $size,
    ], false));
    $attributes = as_attributes($extra)->class(['field', 'field-sm' => $size === 'sm', 'field-lg' => $size === 'lg']);
    $label = as_slot($label, fn($attributes) => $attributes->merge(['id' => $id . '-label', 'for' => $id, 'size' => $size], false)->class(['label']));
    $hint = as_slot($hint, fn($attributes) => ($attributes->has('component') ? $attributes->merge(['size' => $size], false) : $attributes)->merge(['id' => $id . '-hint'], false)->class(['hint']));
    $description = as_slot($description, fn($attributes) => $attributes->merge(['id' => $id . '-description'], false)->class(['description']));
    $error = as_slot($error, fn($attributes) => $attributes->merge(['id' => $id . '-error', 'role' => 'alert'], false)->class(['error']));
@endphp
<div {{ $attributes }}>
    @if($label->isNotEmpty())
    {{ render_slot($label, ['component' => 'ui::label']) }}
    @endif
    {{ render_slot($hint, allowEmpty: true) }}
    {{ render_slot($input, allowEmpty: true) }}
    @if($error->isNotEmpty() || $input->attributes->whereStartsWith('wire:model')->isEmpty())
    {{ render_slot($error, allowEmpty: true) }}
    @else
    @capture($wrapper)
    @error($input->attributes->get('name')){{ $message }}@enderror
    @endcapture
    {{ render_slot($wrapper(), $error->attributes, allowEmpty: true) }}
    @endif
    {{ render_slot($description, allowEmpty: true) }}
</div>