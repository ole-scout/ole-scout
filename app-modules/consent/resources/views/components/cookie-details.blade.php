@props([
    'cookie' => [],
])
@php
    use FossHaas\Consent\CookieType;
@endphp
<div class="grid grid-cols-4 gap-6 fi-fo-component-ctn">
    <x-filament-partials::infolist.text-entry>
        <x-slot name="label">{{ __('Typ') }}</x-slot>
        {{ CookieType::from($cookie['type'])->label() }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-2">
        <x-slot name="label">{{ __('Name') }}</x-slot>
        <span class="font-mono">{{ $cookie['name'] }}</span>
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry>
        <x-slot name="label">{{ __('Laufzeit') }}</x-slot>
        {{ $cookie['duration'] }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-4">
        <x-slot name="label">{{ __('Daten') }}</x-slot>
        {{ $cookie['content'] }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-4">
        <x-slot name="label">{{ __('Zweck') }}</x-slot>
        {{ $cookie['purpose'] }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-4">
        <x-slot name="label">{{ __('Rechtsgrundlage') }}</x-slot>
        {{ $cookie['legalBasis'] }}
    </x-filament-partials::infolist.text-entry>
</div>