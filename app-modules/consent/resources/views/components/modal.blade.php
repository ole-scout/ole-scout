@props([
    'footerActions' => null,
    'heading' => null,
])
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
    <x-slot name="footer">
        <div class="flex gap-3">
            {{ $footerActions }}
        </div>
    </x-slot>
    <x-filament-partials::forms.component-container>
        {{ $slot }}
    </x-filament-partials::forms.component-container>
</x-filament:modal>