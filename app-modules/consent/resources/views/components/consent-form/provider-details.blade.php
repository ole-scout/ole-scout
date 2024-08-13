@use('FossHaas\Support\PhoneNumber')
@props([ 'provider' ])
<x-filament::section collapsible collapsed compact>
    <x-slot:heading>{{ $provider->name }}</x-slot:heading>
    @if($provider->address)
    <x-slot:description>{{ $provider->address }}</x-slot:description>
    @endif
    <div class="grid grid-cols-3 gap-6 fi-fo-component-ctn">
        @if($provider->email())
        <x-filament-partials::infolist.text-entry class="col-span-2">
            <x-slot:label>{{ __('E-Mail-Adresse') }}</x-slot:label>
            <a href="mailto:{{ $provider->email() }}">{{ $provider->email() }}</a>
        </x-filament-partials::infolist.text-entry>
        @endif
        @if($provider->phone())
        <x-filament-partials::infolist.text-entry>
            <x-slot:label>{{ __('Telefonnummer') }}</x-slot:label>
            <a href="{{ PhoneNumber::formatUri($provider->phone()) }}">{{ PhoneNumber::format($provider->phone()) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endif
        @if($provider->privacy_policy())
        <x-filament-partials::infolist.text-entry class="col-span-3">
            <x-slot:label>{{ __('Datenschutz') }}</x-slot:label>
            <a class="underline" href="{{ $url($provider->privacy_policy()) }}" rel="noopener noreferrer" target="_blank">{{ $url($provider->privacy_policy()) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endif
        @if($provider->imprint())
        <x-filament-partials::infolist.text-entry class="col-span-3">
            <x-slot:label>{{ __('Impressum') }}</x-slot:label>
            <a class="underline" href="{{ $url($provider->imprint()) }}" rel="noopener noreferrer" target="_blank">{{ $url($provider->imprint()) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endif
        @if($provider->contact())
        <x-filament-partials::infolist.text-entry class="col-span-3">
            <x-slot:label>{{ __('Kontaktformular') }}</x-slot:label>
            <a class="underline" href="{{ $url($provider->contact()) }}" rel="noopener noreferrer" target="_blank">{{ $url($provider->contact()) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endif
    </div>
</x-filament::section>