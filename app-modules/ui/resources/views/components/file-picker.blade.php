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
<x-ui::button {{ $attributes->only($buttonProps)->merge(
    [...$extra, 'as' => 'label', 'disabled' => $disabled], false
)->class(['focus-within:ring']) }}>
    <input {{ $attributes->except($buttonProps)->merge(
        ['disabled' => $disabled, 'type' => 'file'], false
    )->class(['sr-only']) }} />
    <span>{{ $slot }}</span>
</x-ui::button>