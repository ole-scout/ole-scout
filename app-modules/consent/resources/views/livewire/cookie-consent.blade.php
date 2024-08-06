<div class="">
    <x-filament::modal
        id="cookie-consent"
        x-init="$dispatch('open-modal',{id:'cookie-consent'})"
        width="5xl"
        sticky-header
        sticky-footer
        :close-by-clicking-away="false"
        :close-by-escaping="false"
        :close-button="false"
        slide-over
    >
        <x-slot name="heading">
            {{ __('Datenschutz-Einstellungen') }}
        </x-slot>
        <x-slot name="footer">
            <div class="flex gap-3">
                <x-filament::button class="flex-grow" wire:click="save(true)">{{ __('Alle akzeptieren') }}</x-filament::button>
                <x-filament::button class="flex-grow" wire:click="save">{{ __('Auswahl speichern') }}</x-filament::button>
            </div>
        </x-slot>
        <form wire:submit="save">
            {{ $this->form }}
        </form>
    </x-filament:modal>
    <script>
        $dispatch('open-modal', { id: 'cookie-consent' });
    </script>
    <x-filament-actions::modals />
</div>
