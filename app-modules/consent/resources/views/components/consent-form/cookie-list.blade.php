@props([ 'cookies' => [] ])
<x-filament::section collapsible collapsed compact>
    <x-slot:heading>{{ __('Technische Details') }}</x-slot:heading>
    <ul class="grid grid-cols-1 gap-4">
        @foreach($cookies as $cookie)
        <li class="block p-4 bg-white shadow-sm fi-in-repeatable-item rounded-xl ring-1 ring-gray-950/5 dark:bg-white/5 dark:ring-white/10">
            <x-consent::consent-form.cookie-details :$cookie />
        </li>
        @endforeach
    </ul>
</x-filament::section>