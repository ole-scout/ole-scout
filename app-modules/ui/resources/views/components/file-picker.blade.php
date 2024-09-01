@props([
    'disabled' => false,
])
@php
    $inputProps = [
        'accept',
        'form',
        'multiple',
        'name',
        'required',
        'tabindex',
    ];
@endphp
<x-ui::button as="label" {{ $attributes->filter(
    fn (string $value, string $key) => !in_array($key, $inputProps)
)->merge(['disabled' => $disabled])->class(['focus-within:ring']) }}>
    <input type="file" {{ $attributes->filter(
        fn (string $value, string $key) => in_array($key, $inputProps)
    )->merge(['disabled' => $disabled])->class(['sr-only']) }} />
    <span>{{ $slot }}</span>
</x-ui::button>