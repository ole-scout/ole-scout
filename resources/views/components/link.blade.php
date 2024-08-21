@props(['href'])
@php
  $isExternal = substr($href, 0, 1) !== '/';
  if (!$isExternal) $href = url($href);
@endphp
<x-filament::link href="{{ $href }}" {{ $attributes->merge($isExternal ? [
  'target' => '_blank',
  'rel' => 'noopener noreferrer',
  'class' => 'external-link',
] : []) }}>{{ $slot }}</x-filament::link>