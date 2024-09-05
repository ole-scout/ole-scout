@props([
    'size' => null,
    'wrapped' => false,
    'proxyAttributes' => [],
])
@if(!$wrapped)<label>@endif
    <input {{ $attributes->except(['class'])->merge(
        ['type' => 'checkbox', 'class' => 'sr-only']
    ) }}>
    <span {{ $attributes->only(['class'])->merge($proxyAttributes)->class(
        ['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']
    ) }}>
        <x-ui::icon :$size icon="checkmark" class="toggle" aria-hidden="true" />
    </span>
@if(!$wrapped)</label>@endif