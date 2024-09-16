@use('FossHaas\Support\PhoneNumber')
@props([
    'provider',
])
<x-ui::section.collapsible
    :label="$provider->name"
    :description="$provider->address"
>
    <x-slot:slot component="ui::data-grid">
        @if($provider->email)
        <x-ui::data-grid.entry>
            <x-slot:label>{{ __('E-Mail-Adresse') }}</x-slot:label>
            <x-ui::button href="mailto:{{ $provider->email }}">{{ $provider->email }}</x-ui::button>
        </x-ui::data-grid.entry>
        @endif
        @if($provider->phone)
        <x-ui::data-grid.entry>
            <x-slot:label>{{ __('Telefonnummer') }}</x-slot:label>
            <x-ui::button href="{{ PhoneNumber::formatUri($provider->phone) }}">{{ PhoneNumber::format($provider->phone) }}</x-ui::button>
        </x-ui::data-grid.entry>
        @endif
        @if($provider->privacy_policy)
        <x-ui::data-grid.entry>
            <x-slot:label>{{ __('Datenschutz') }}</x-slot:label>
            <x-ui::button class="underline" href="{{ $provider->privacy_policy }}">{{ $provider->privacy_policy }}</x-ui::button>
        </x-ui::data-grid.entry>
        @endif
        @if($provider->imprint)
        <x-ui::data-grid.entry>
            <x-slot:label>{{ __('Impressum') }}</x-slot:label>
            <x-ui::button class="underline" href="{{ $provider->imprint }}">{{ $provider->imprint }}</x-ui::button>
        </x-ui::data-grid.entry>
        @endif
        @if($provider->contact)
        <x-ui::data-grid.entry>
            <x-slot:label>{{ __('Kontaktformular') }}</x-slot:label>
            <x-ui::button class="underline" href="{{ $provider->contact }}">{{ $provider->contact }}</x-ui::button>
        </x-ui::data-grid.entry>
        @endif
    </x-slot:slot>
</x-ui::section.collapsible>
