@use('FossHaas\Support\Duration')
@props([
    'as' => 'x-ui::data-grid.entry',
    'cookie',
])
<x-ui::card :$attributes>
    <x-slot:slot component="ui::data-grid" class="m-0 sm:grid-cols-5">
        <x-ui::data-grid.entry span="3">
            <x-slot:label>{{ __('Name') }}</x-slot:label>
            <x-slot:slot class="font-mono break-words">{{ $cookie->name }}</x-slot:slot>
        </x-ui::data-grid.entry>
        <x-ui::data-grid.entry span="2">
            <x-slot:label>{{ __('Typ') }}</x-slot:label>
            {{ $cookie->type->label() }}
        </x-ui::data-grid.entry>
        <x-ui::data-grid.entry span="full">
            <x-slot:label>{{ __('Host') }}</x-slot:label>
            <x-slot:slot class="font-mono break-words">{{ $cookie->host ?? config('app.url') }}</x-slot:slot>
        </x-ui::data-grid.entry>
        @if($cookie->description)
        <x-ui::data-grid.entry span="full">
            <x-slot:label>{{ __('Beschreibung') }}</x-slot:label>
            {!! markdown($cookie->description) !!}
        </x-ui::data-grid.entry>
        @endif
        <x-ui::data-grid.entry span="3">
            <x-slot:label>{{ __('Rechtsgrundlage') }}</x-slot:label>
            <div>{{ $cookie->legal_basis->description() }}</div>
            <div class="text-gray-700 dark:text-gray-400">{{ $cookie->legal_basis->label() }}</div>
        </x-ui::data-grid.entry>
        <x-ui::data-grid.entry span="2">
            <x-slot:label>{{ __('Laufzeit') }}</x-slot:label>
            {{ Duration::format($cookie->duration) }}
        </x-ui::data-grid.entry>
    </x-slot:slot>
</x-ui::card>