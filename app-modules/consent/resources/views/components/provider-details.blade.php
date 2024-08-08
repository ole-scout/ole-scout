@props([
    'provider' => [],
])
<x-filament::section collapsible collapsed compact>
    <x-slot name="heading">{{ $provider['name'] }}</x-slot>
    @if (array_key_exists('address', $provider) && !empty($provider['address']))
    <x-slot name="description">{{ $provider['address'] }}</x-slot>
    @endif
    <div class="grid grid-cols-3 gap-6 fi-fo-component-ctn">
        @if (array_key_exists('email', $provider) && !empty($provider['email']))
        <x-filament-partials::infolist.text-entry class="col-span-2">
            <x-slot name="label">{{ __('E-Mail-Adresse') }}</x-slot>
            <a href="mailto:{{ $provider['email'] }}">{{ $provider['email'] }}</a>
        </x-filament-partials::infolist.text-entry>
        @endif
        @if (array_key_exists('phone', $provider) && !empty($provider['phone']))
        <x-filament-partials::infolist.text-entry>
            <x-slot name="label">{{ __('Telefonnummer') }}</x-slot>
            <a href="tel:{{ $provider['phone'] }}">{{ $formatPhone($provider['phone']) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endif
        @if (array_key_exists('privacyPolicy', $provider) && !empty($provider['privacyPolicy']))
        <x-filament-partials::infolist.text-entry class="col-span-3">
            <x-slot name="label">{{ __('Datenschutz') }}</x-slot>
            <a class="underline" href="{{ $url($provider['privacyPolicy']) }}" rel="noopener noreferrer" target="_blank">{{ $url($provider['privacyPolicy']) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endif
        @if (array_key_exists('imprint', $provider) && !empty($provider['imprint']))
        <x-filament-partials::infolist.text-entry class="col-span-3">
            <x-slot name="label">{{ __('Impressum') }}</x-slot>
            <a class="underline" href="{{ $url($provider['imprint']) }}" rel="noopener noreferrer" target="_blank">{{ $url($provider['imprint']) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endif
        @if (array_key_exists('contact', $provider) && !empty($provider['contact']))
        <x-filament-partials::infolist.text-entry class="col-span-3">
            <x-slot name="label">{{ __('Kontaktformular') }}</x-slot>
            <a class="underline" href="{{ $url($provider['contact']) }}" rel="noopener noreferrer" target="_blank">{{ $url($provider['contact']) }}</a>
        </x-filament-partials::infolist.text-entry>
        @endif
    </div>
</x-filament::section>