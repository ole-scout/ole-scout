@props([
    'size' => null,
    'wrapped' => false,
    'proxyAttributes' => [],
])
@if(!$wrapped)<label>@endif
    <input {{ $attributes->except(['class'])->merge(
        ['type' => 'radio', 'class' => 'sr-only']
    ) }}>
    <span {{ $attributes->only(['class'])->merge($proxyAttributes)->class(
        ['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']
    ) }}>
        @svg('fluentui-circle-' . match($size) {
            'sm' => '12',
            default => '16',
            'lg' => '16',
        }, ['class' => 'toggle'])
    </span>
@if(!$wrapped)</label>@endif