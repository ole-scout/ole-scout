@capture($wrapper, $content)
<div class="fixed inset-0 sm:p-8 backdrop-blur bg-black/25">
    <x-ui::card as="dialog" open aria-modal="true" class="w-full sm:max-w-4xl max-h-screen sm:max-h-[calc(100vh-4rem)] mx-auto" x-trap.inert="true">
        <x-slot:icon circle>shield-person</x-slot:icon>
        <x-slot:title>{{ __('Datenschutz-Einstellungen') }}</x-slot:title>
        <x-slot:slot class="overflow-y-auto">
            <x-core-ui::theme-picker class="absolute top-0 -left-48" />
            <div class="flex flex-col gap-4">
                {{ $content() }}
            </div>
        </x-slot:slot>
        <x-slot:footer class="flex gap-4">
            <x-ui::button
                intent="primary"
                formId="consent"
                class="justify-center flex-grow"
                x-on:click="selectAllAndSubmit()"
            >
                {{ __('Alle akzeptieren') }}
            </x-ui::button>
            <x-ui::button
                intent="primary"
                formId="consent"
                class="justify-center flex-grow"
                x-on:click="submit()"
            >
                {{ __('Auswahl speichern') }}
            </x-ui::button>
        </x-slot:footer>
    </x-ui::card>
</div>
@endcapture
<x-consent::consent-form :$wrapper alpineAfterSubmit="window.location.reload()" />