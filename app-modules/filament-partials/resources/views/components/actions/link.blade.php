@props([
    'button' => false,
])
<x-filament::link
    :attributes="$attributes->merge([
        'class' => 'fi-ac-link-action',
        ...($button ? ['tag' => 'button', 'type' => 'button'] : []),
    ])"
>{{ $slot }}</x-filament::link>