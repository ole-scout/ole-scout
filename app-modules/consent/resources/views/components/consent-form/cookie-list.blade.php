@props([
    'cookies' => [],
])
<x-ui::section.collapsible collapsed>
    <x-slot:label>{{ __('Technical details') }}</x-slot:label>
    <x-slot:slot class="grid grid-cols-1 gap-4 md:grid-cols-2">
        @foreach($cookies as $cookie)
        <x-consent::consent-form.cookie-details :$cookie as="li" />
        @endforeach
    </x-slot:slot>
</x-ui::section.collapsible>