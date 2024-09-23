@props([
    'id' => 'consent-modal',
])
<div class="fixed inset-0 lg:p-8 backdrop-blur bg-black/25">
    <x-ui::card as="dialog" open aria-modal="true" class="w-full lg:max-w-4xl max-h-screen lg:max-h-[calc(100vh-4rem)] mx-auto" x-trap.inert="true">
        <x-slot:icon class="circle" icon=":shield-person"></x-slot:icon>
        <x-slot:title>{{ __('Privacy settings') }}</x-slot:title>
        <x-slot:slot class="overflow-y-auto">
            <x-core-ui::theme-picker class="absolute top-0 -left-48" x-ui-busy:ignore />
            <x-consent::consent-form :$id class="flex flex-col gap-4">
                <x-slot:slot hidden>
                    <template x-teleport="#{{ $id . '-footer' }}">
                        <div class="flex gap-4">
                            <x-ui::button
                                type="submit"
                                :form="$id"
                                class="justify-center flex-1"
                                name="accept-all"
                                x-ui-busy
                            >
                                {{ __('Accept all & continue') }}
                            </x-ui::button>
                            <x-ui::button
                                type="submit"
                                :form="$id"
                                class="justify-center flex-1"
                                x-ui-busy
                            >
                                {{ __('Save & continue') }}
                            </x-ui::button>
                        </div>
                    </template>
                </x-slot:slot>
            </x-consent::consent-form>
        </x-slot:slot>
        <x-slot:footer :id="$id . '-footer'"></x-slot:footer>
    </x-ui::card>
</div>