<x-layouts.app size="lg">
    <x-slot:title>{{ __('Privacy settings') }}</x-slot:title>
    <x-ui::dialog>
        <x-slot:title>{{ __('Privacy settings') }}</x-slot:title>
        <x-slot:icon class="circle" icon=":shield-person"></x-slot:icon>
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
                        {{ __('Revoke consent') }}
                    </x-ui::button>
                </div>
                <x-ui::button
                    type="submit"
                    name="accept-all"
                    x-bind:disabled="isAllSelected() && !isDirty"
                    x-ui-busy
                >
                    {{ __('Accept all & save') }}
                </x-ui::button>
                <x-ui::button
                    type="submit"
                    form="consent-form"
                    x-bind:disabled="canRevoke && !isDirty"
                    x-ui-busy
                    disabled
                >
                    {{ __('Save selected') }}
                </x-ui::button>
            </div>
        </x-consent::consent-form>
    </x-ui::dialog>
</x-layouts.app>