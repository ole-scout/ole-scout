@props([
    'name' => null,
    'value' => null,
    'options' => [],
    'disabled' => false,
    'hiddenLabel' => false,
    'subtle' => false,
    'vertical' => false,
    'size' => null,
    'extra' => [],
])
@php
    $type = count($options) > 1 ? 'radio' : 'checkbox';
    $inputAttributes = $attributes->only([])->merge([
        'name' => $name,
        'type' => $type,
    ])->class(['sr-only']);
    if ($vertical) $options = array_reverse($options);
@endphp
@if(count($options) > 0)
<div {{ $attributes->class(
    ['toggle-group', 'subtle' => $subtle, 'vertical' => $vertical]
) }}>
    @foreach($options as $option)
    <x-ui::button
        :wire:key="$option['value']"
        :icon="$option['icon']"
        :$hiddenLabel
        :$size
        variant="neutral"
        as="label"
    >
        {{ $option['label'] }}
        <input {{ $inputAttributes->merge([
            'value' => $option['value'],
            'checked' => $option['value'] === $value,
            'disabled' => $disabled ? 'disabled' : null,
        ]) }} />
    </x-ui::button>
    @endforeach
</div>
@endif