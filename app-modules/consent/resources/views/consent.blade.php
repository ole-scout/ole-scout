<x-layouts.app size="lg">
    <x-slot:icon class="circle" icon=":shield-person"></x-slot:icon>
    <x-slot:title>{{ __('Datenschutz-Einstellungen') }}</x-slot:title>
    <x-slot:slot>
        <x-consent::consent-form id="consent-form" class="flex flex-col gap-4">
            <div class="flex gap-4">
                <div class="flex flex-grow gap-4">
                    <x-ui::button
                        type="submit"
                        form="consent-form"
                        name="revoke"
                        intent="danger"
                        variant="ghost"
                        x-show="canRevoke"
                        x-ui-busy
                        x-cloak
                    >
                        {{ __('Einwilligung widerrufen') }}
                    </x-ui::button>
                </div>
                <x-ui::button
                    type="submit"
                    name="accept-all"
                    x-bind:disabled="isAllSelected() && !isDirty"
                    x-ui-busy
                >
                    {{ __('Alle akzeptieren & speichern') }}
                </x-ui::button>
                <x-ui::button
                    type="submit"
                    form="consent-form"
                    x-bind:disabled="canRevoke && !isDirty"
                    x-ui-busy
                    disabled
                >
                    {{ __('Auswahl speichern') }}
                </x-ui::button>
            </div>
        </x-consent::consent-form>
    </x-slot:slot>
</x-layouts.app>