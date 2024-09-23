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
            <x-slot:label>{{ __('Email address') }}</x-slot:label>
            <x-ui::button href="mailto:{{ $provider->email }}">{{ $provider->email }}</x-ui::button>
        </x-ui::data-grid.entry>
        @endif
        @if($provider->phone)
        <x-ui::data-grid.entry>
            <x-slot:label>{{ __('Phone number') }}</x-slot:label>
            <x-ui::button href="{{ PhoneNumber::formatUri($provider->phone) }}">{{ PhoneNumber::format($provider->phone) }}</x-ui::button>
        </x-ui::data-grid.entry>
        @endif
        @if($provider->privacy_policy)
        <x-ui::data-grid.entry>
            <x-slot:label>{{ __('Privacy policy') }}</x-slot:label>
            <x-ui::button class="underline" href="{{ $provider->privacy_policy }}">{{ $provider->privacy_policy }}</x-ui::button>
        </x-ui::data-grid.entry>
        @endif
        @if($provider->imprint)
        <x-ui::data-grid.entry>
            <x-slot:label>{{ __('Imprint') }}</x-slot:label>
            <x-ui::button class="underline" href="{{ $provider->imprint }}">{{ $provider->imprint }}</x-ui::button>
        </x-ui::data-grid.entry>
        @endif
        @if($provider->contact)
        <x-ui::data-grid.entry>
            <x-slot:label>{{ __('Contact form') }}</x-slot:label>
            <x-ui::button class="underline" href="{{ $provider->contact }}">{{ $provider->contact }}</x-ui::button>
        </x-ui::data-grid.entry>
        @endif
    </x-slot:slot>
</x-ui::section.collapsible>
