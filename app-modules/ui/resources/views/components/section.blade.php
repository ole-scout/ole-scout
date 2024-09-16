@props([
    'as' => 'div',
    'header' => null,
    'label' => null,
    'description' => null,
    'slot' => null,
])
@php
    $attributes = as_attributes($attributes);
    $header = as_slot($header);
    $label = as_slot($label);
    $description = as_slot($description);
    $slot = as_slot($slot);
@endphp
<{{ $as }} {{ $attributes->class(['section']) }}>
    @capture($transformHeader, $contents)
        {{ render_slot(
            $label,
            ['class' => 'title']
        ) }}
        @if($description->isNotEmpty())
        {{ render_slot(
            $description,
            ['class' => 'description']
        ) }}
        @endif
        {{ $contents }}
    @endcapture
    {{ render_slot(
        $header,
        ['class' => 'header'],
        transform: $transformHeader,
    ) }}
    {{ render_slot(
        $slot,
        ['class' => 'body'],
    ) }}
</{{ $as }}>