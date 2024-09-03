@props([
    'size' => null,
    'wrapped' => false,
    'proxyAttributes' => [],
])
@if(!$wrapped)<label>@endif
    <input {{ $attributes->except(['class'])->merge(
        ['type' => 'checkbox', 'class' => 'sr-only', 'role' => 'switch']
    ) }}>
    <span {{ $attributes->only(['class'])->merge($proxyAttributes)->class(
        ['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']
    ) }}>
        <span class="toggle"></span>
    </span>
@if(!$wrapped)</label>@endif