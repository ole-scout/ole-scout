@props([
    'input',
    'label' => null,
    'hint' => null,
    'description' => null,
    'error' => null,
    'id' => null,
    'size' => null,
    'action' => null,
    'actionTrailing' => null,
    'extra' => [],
])
@php
    $id = $id ?: 'input-' . bin2hex(random_bytes(5));
    $inputAttributes = $attributes->merge([
        'id' => $id,
        'action' => $action,
        'actionTrailing' => $actionTrailing,
        'aria-labelledby' => $id . '-label',
        'aria-describedby' => $id . '-description',
        'size' => $size,
    ]);
    $attributes = $attributes->only([])->merge($extra);
    $labelAttributes = (
        isset($label->attributes)
        ? $label->attributes->get('attributes') ?: $label->attributes
        : $attributes->only([])
    )->merge(['id' => $id . '-label', 'for' => $id, 'size' => $size])->class(['label']);
    $hintAttributes = (
        isset($hint->attributes)
        ? $hint->attributes->get('attributes') ?: $hint->attributes
        : $attributes->only([])
    )->merge(['id' => $id . '-hint'])->class(['hint']);
    if ($hintAttributes->has('component')) {
        $hintComponent = $hintAttributes->get('component');
        $hintAttributes = $hintAttributes->except('component')->merge(['size' => $size]);
    }
    $descriptionAttributes = (
        isset($description->attributes)
        ? $description->attributes->get('attributes') ?: $description->attributes
        : $attributes->only([])
    )->merge(['id' => $id . '-description'])->class(['description']);
    $errorAttributes = (
        isset($error->attributes)
        ? $error->attributes->get('attributes') ?: $error->attributes
        : $attributes->only([])
    )->merge(['id' => $id . '-error'])->class(['error']);
@endphp
<div {{ $attributes->class(['field', 'field-sm' => $size === 'sm', 'field-lg' => $size === 'lg']) }}>
    @if($label)<x-ui::label :attributes="$labelAttributes">{{ $label }}</x-ui::label>@endif
    @isset($hintComponent)
    <x-dynamic-component :component="$hintComponent" :attributes="$hintAttributes">{{ $hint }}</x-dynamic-component>
    @else
    <div {{ $hintAttributes }}>{{ $hint }}</div>
    @endif
    <x-ui::input :attributes="$inputAttributes" />
    <div {{ $descriptionAttributes }}>{{ $description }}</div>
    <div {{ $errorAttributes }}>{{ $error }}</div>
</div>