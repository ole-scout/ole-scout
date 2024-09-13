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
        'iconAttributes',
        'hiddenLabel',
        'hiddenIcons',
    ];
@endphp
<x-ui::button {{ as_attributes($attributes->only($buttonProps), $extra)->merge(
    ['as' => 'label', 'disabled' => $disabled]
)->class(['focus-within:ring']) }}>
    <input {{ $attributes->except($buttonProps)->merge(
        ['disabled' => $disabled, 'type' => 'file']
    )->class(['sr-only']) }} />
    <span>{{ $slot }}</span>
</x-ui::button>