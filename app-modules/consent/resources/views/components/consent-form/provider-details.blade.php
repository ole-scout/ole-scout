@use('FossHaas\Util\PhoneNumber')
@props([ 'provider' ])
<x-filament::section collapsible collapsed compact>
    <x-slot:heading>{{ $provider['name'] }}</x-slot:heading>
    @isset($provider['address'])
    <x-slot:description>{{ $provider['address'] }}</x-slot:description>
    @endisset
    <div class="grid grid-cols-3 gap-6 fi-fo-component-ctn">
        @isset($provider['email'])
        <x-filament-partials::infolist.text-entry class="col-span-2">
            <x-slot:label>{{ __('E-Mail-Adresse') }}</x-slot:label>
            <a href="mailto:{{ $provider['email'] }}">{{ $provider['email'] }}</a>
        </x-filament-partials::infolist.text-entry>
        @endisset
        @isset($provider['phone'])
        <x-filament-partials::infolist.text-entry>
            <x-slot:label>{{ __('Telefonnummer') }}</x-slot:label>
            <a href="tel:{{ $provider['phone'] }}">{{ PhoneNumber::format($provider['phone']) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endisset
        @isset($provider['privacyPolicy'])
        <x-filament-partials::infolist.text-entry class="col-span-3">
            <x-slot:label>{{ __('Datenschutz') }}</x-slot:label>
            <a class="underline" href="{{ $url($provider['privacyPolicy']) }}" rel="noopener noreferrer" target="_blank">{{ $url($provider['privacyPolicy']) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endisset
        @isset($provider['imprint'])
        <x-filament-partials::infolist.text-entry class="col-span-3">
            <x-slot:label>{{ __('Impressum') }}</x-slot:label>
            <a class="underline" href="{{ $url($provider['imprint']) }}" rel="noopener noreferrer" target="_blank">{{ $url($provider['imprint']) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endisset
        @isset($provider['contact'])
        <x-filament-partials::infolist.text-entry class="col-span-3">
            <x-slot:label>{{ __('Kontaktformular') }}</x-slot:label>
            <a class="underline" href="{{ $url($provider['contact']) }}" rel="noopener noreferrer" target="_blank">{{ $url($provider['contact']) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endisset
    </div>
</x-filament::section>