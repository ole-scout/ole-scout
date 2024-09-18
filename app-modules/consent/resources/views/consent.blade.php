<x-layouts.app size="lg">
    <x-slot:icon class="circle" icon=":shield-person"></x-slot:icon>
    <x-slot:title>{{ __('Datenschutz-Einstellungen') }}</x-slot:title>
    <x-slot:slot>
        <x-consent::consent-form id="consent-form" class="flex flex-col gap-4">
            <div class="flex justify-between gap-4">
                <div class="flex flex-row-reverse gap-4">
                    <x-ui::button
                        type="submit"
                        form="consent-form"
                        name="revoke"
                        x-show="canRevoke"
                        intent="danger"
                        variant="alt"
                        x-cloak
                    >
                        {{ __('Einwilligung widerrufen') }}
                    </x-ui::button>
                </div>
                <x-ui::button
                    type="submit"
                    form="consent-form"
                    x-bind:disabled="!isDirty"
                    disabled
                >
                    {{ __('Auswahl speichern') }}
                </x-ui::button>
            </div>
        </x-consent::consent-form>
    </x-slot:slot>
</x-layouts.app>