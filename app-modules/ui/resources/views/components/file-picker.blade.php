@props([
    'disabled' => false,
    'size' => null,
    'extra' => [],
])
@php
    $buttonProps = [
        'as',
        'class',
        'size',
        'intent',
        'variant',
        'icon',
        'iconTrailing',
        'hiddenLabel',
        'hiddenIcons',
    ];
    $attributes = as_attributes($attributes);
    $buttonAttributes = as_attributes(
        $attributes->only($buttonProps),
        $extra
    )->merge(
        ['as' => 'label', 'disabled' => $disabled]
    )->class(['focus-within:ring']);
    $inputAttributes = as_attributes($attributes->except($buttonProps))->merge(
        ['disabled' => $disabled, 'type' => 'file']
    )->class(['sr-only']);
@endphp
<x-ui::button :attributes="$buttonAttributes">
    <input {{ $inputAttributes }} />
    <span>{{ $slot }}</span>
</x-ui::button>