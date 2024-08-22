@capture($wrapper, $content)
<x-filament::modal
    id="consent-modal"
    width="5xl"
    sticky-header
    sticky-footer
    slide-over
    visible
    :close-by-clicking-away="false"
    :close-by-escaping="false"
    :close-button="false"
    x-init="$dispatch('open-modal', { id: 'consent-modal' })"
>
    <x-slot:heading>
        {{ __('Datenschutz-Einstellungen') }}
    </x-slot:heading>
    <x-slot:footer>
        <div class="flex gap-3">
            <x-filament::button
                formId="consent"
                class="flex-grow"
                x-on:click="selectAllAndSubmit()"
            >
                {{ __('Alle akzeptieren') }}
            </x-filament::button>
            <x-filament::button
                formId="consent"
                class="flex-grow"
                x-on:click="submit()"
            >
                {{ __('Auswahl speichern') }}
            </x-filament::button>
        </div>
    </x-slot:footer>
    <x-filament-partials::forms.component-container>
        {{ $content() }}
    </x-filament-partials::forms.component-container>
</x-filament:modal>
@endcapture
<x-consent::consent-form :$wrapper alpineAfterSubmit="window.location.reload()" />