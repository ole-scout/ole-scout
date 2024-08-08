@props([
    'footerActions' => null,
    'heading' => null,
])
@capture($wrapper, $content)
<x-filament::modal
    id="consent-modal"
    width="5xl"
    sticky-header
    sticky-footer
    :close-by-clicking-away="false"
    :close-by-escaping="false"
    :close-button="false"
    slide-over
    visible
    :heading="$heading"
    x-init="$dispatch('open-modal', { id: 'consent-modal' })"
>
    <x-slot name="heading">
        {{ __('Datenschutz-Einstellungen') }}
    </x-slot>
    <x-slot name="footer">
        <div class="flex gap-3">
            <x-filament::button formId="consent" class="flex-grow" @click="selectAllAndSubmit()">{{ __('Alle akzeptieren') }}</x-filament::button>
            <x-filament::button formId="consent" class="flex-grow" @click="submit()">{{ __('Auswahl speichern') }}</x-filament::button>
        </div>
    </x-slot>
    <x-filament-partials::forms.component-container>
        {{ $content() }}
    </x-filament-partials::forms.component-container>
</x-filament:modal>
@endcapture
<x-consent::consent-form :wrapper="$wrapper" />