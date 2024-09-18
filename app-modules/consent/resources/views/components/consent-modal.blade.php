@props([
    'id' => 'consent-modal',
])
<div class="fixed inset-0 sm:p-8 backdrop-blur bg-black/25">
    <x-ui::card as="dialog" open aria-modal="true" class="w-full sm:max-w-4xl max-h-screen sm:max-h-[calc(100vh-4rem)] mx-auto" x-trap.inert="true">
        <x-slot:icon class="circle" icon=":shield-person"></x-slot:icon>
        <x-slot:title>{{ __('Datenschutz-Einstellungen') }}</x-slot:title>
        <x-slot:slot class="overflow-y-auto">
            <x-core-ui::theme-picker class="absolute top-0 -left-48" />
            <x-consent::consent-form :$id class="flex flex-col gap-4" />
        </x-slot:slot>
        <x-slot:footer class="flex gap-4">
            <x-ui::button
                type="submit"
                :form="$id"
                class="justify-center flex-grow"
                name="accept-all"
            >
                {{ __('Alle akzeptieren') }}
            </x-ui::button>
            <x-ui::button
                type="submit"
                :form="$id"
                class="justify-center flex-grow"
            >
                {{ __('Auswahl speichern') }}
            </x-ui::button>
        </x-slot:footer>
    </x-ui::card>
</div>