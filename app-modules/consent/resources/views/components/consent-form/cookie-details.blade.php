@use('FossHaas\Consent\CookieType')
@props([ 'cookie' ])
<div class="grid grid-cols-4 gap-6 fi-fo-component-ctn">
    <x-filament-partials::infolist.text-entry>
        <x-slot:label>{{ __('Typ') }}</x-slot:label>
        {{ CookieType::from($cookie['type'])->label() }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-2">
        <x-slot:label>{{ __('Name') }}</x-slot:label>
        <span class="font-mono">{{ $cookie['name'] }}</span>
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry>
        <x-slot:label>{{ __('Laufzeit') }}</x-slot:label>
        {{ $cookie['duration'] }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-4">
        <x-slot:label>{{ __('Daten') }}</x-slot:label>
        {{ $cookie['content'] }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-4">
        <x-slot:label>{{ __('Zweck') }}</x-slot:label>
        {{ $cookie['purpose'] }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-4">
        <x-slot:label>{{ __('Rechtsgrundlage') }}</x-slot:label>
        {{ $cookie['legalBasis'] }}
    </x-filament-partials::infolist.text-entry>
</div>