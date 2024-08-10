@use('FossHaas\Consent\CookieType')
@use('FossHaas\Consent\LegalBasis')
@use('FossHaas\Util\Duration')
@props([ 'cookie' ])
<x-filament-partials::forms.component-container class="sm:grid-cols-5">
    <x-filament-partials::infolist.text-entry class="col-span-2">
        <x-slot:label>{{ __('Typ') }}</x-slot:label>
        {{ CookieType::from($cookie['type'])->label() }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-3">
        <x-slot:label>{{ __('Name') }}</x-slot:label>
        <span class="font-mono">{{ $cookie['name'] }}</span>
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-5">
        <x-slot:label>{{ __('Daten') }}</x-slot:label>
        {{ $cookie['content'] }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-5">
        <x-slot:label>{{ __('Zweck') }}</x-slot:label>
        {{ $cookie['purpose'] }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-2">
        <x-slot:label>{{ __('Laufzeit') }}</x-slot:label>
        {{ Duration::format($cookie['duration']) }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-3">
        <x-slot:label>{{ __('Rechtsgrundlage') }}</x-slot:label>
        {{ LegalBasis::from($cookie['legalBasis'])->description() }}
        <div>{{ LegalBasis::from($cookie['legalBasis'])->label() }}</div>
    </x-filament-partials::infolist.text-entry>
</x-filament-partials::forms.component-container>