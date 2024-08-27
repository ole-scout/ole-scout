@use('FossHaas\Support\Duration')
@props([ 'cookie' ])
<x-filament-partials::forms.component-container class="sm:grid-cols-5">
    <x-filament-partials::infolist.text-entry class="col-span-2">
        <x-slot:label>{{ __('Typ') }}</x-slot:label>
        {{ $cookie->type->label() }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-3">
        <x-slot:label>{{ __('Name') }}</x-slot:label>
        <span class="font-mono">{{ $cookie->name }}</span>
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-3">
        <x-slot:label>{{ __('Host') }}</x-slot:label>
        <span class="font-mono">{{ $cookie->host }}</span>
    </x-filament-partials::infolist.text-entry>
    @if($cookie->description)
    <x-filament-partials::infolist.text-entry class="col-span-5">
        <x-slot:label>{{ __('Beschreibung') }}</x-slot:label>
        {!! markdown($cookie->description) !!}
    </x-filament-partials::infolist.text-entry>
    @endif
    <x-filament-partials::infolist.text-entry class="col-span-2">
        <x-slot:label>{{ __('Laufzeit') }}</x-slot:label>
        {{ Duration::format($cookie->duration) }}
    </x-filament-partials::infolist.text-entry>
    <x-filament-partials::infolist.text-entry class="col-span-3">
        <x-slot:label>{{ __('Rechtsgrundlage') }}</x-slot:label>
        {{ $cookie->legal_basis->description() }}
        <div>{{ $cookie->legal_basis->label() }}</div>
    </x-filament-partials::infolist.text-entry>
</x-filament-partials::forms.component-container>