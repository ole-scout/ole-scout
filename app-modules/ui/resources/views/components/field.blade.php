@props([
    'name',
    'inline' => false,
    'size' => null,
    'label' => null,
    'hint' => null,
    'input' => null,
    'action' => null,
    'actionTrailing' => null,
    'description' => null,
    'error' => null,
])
@php
    $as = $inline !== false ? 'span' : 'div';
    $attributes = as_attributes($attributes, [
        'x-id' => '[\'field\']',
        'class' => [
            'field',
            'field-sm' => $size === 'sm',
            'field-lg' => $size === 'lg',
            'field-inline' => $inline !== false,
        ],
    ]);
    $label = as_slot($label);
    $hint = as_slot($hint);
    $input = as_slot($input, [
        'component' => 'ui::input',
        'action' => $action,
        'actionTrailing' => $actionTrailing,
        'name' => isset($name) ? $name : null,
        'size' => $size,
        'x-bind:id' => '$id(\'field\', \'input\')',
        'x-bind:aria-labelledby' => '$id(\'field\', \'label\')',
        'x-bind:aria-describedby' => '$id(\'field\', \'description\')',
    ]);
    $description = as_slot($description);
    $error = as_slot($error);
@endphp
<{{ $as }} {{ $attributes }}>
    @if($inline === 'trailing'){{ render_slot($input) }}@endif
    @if($label->isNotEmpty())
    {{ render_slot($label, [
        'component' => 'ui::label',
        'size' => $size,
        'class' => 'label',
        'x-bind:id' => '$id(\'field\', \'label\')',
        'x-bind:for' => '$id(\'field\', \'input\')',
    ]) }}
    @endif
    @if($hint->isNotEmpty())
    {{ render_slot($hint, [
        'size' => $hint->attributes->has('component') ? $size : null,
        'class' => 'hint',
        'x-bind:id' => '$id(\'field\', \'hint\')',
    ]) }}
    @endif
    @if($inline !== 'trailing'){{ render_slot($input) }}@endif
    @capture($transformError, $contents)
    @error($name){{ $message }}@enderror
    {{ $contents }}
    @endcapture
    {{ render_slot($error, [
        'class' => 'error',
        'role' => 'alert',
        'x-bind:id' => '$id(\'field\', \'error\')',
    ], transform: $transformError) }}
    @if($description->isNotEmpty())
    {{ render_slot($description, [
        'class' => 'description',
        'x-bind:id' => '$id(\'field\', \'description\')',
    ]) }}
    @endif
</{{ $as }}>