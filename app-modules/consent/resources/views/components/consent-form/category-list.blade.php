@props([ 'categories' => [] ])
<x-filament-partials::forms.component-container
    {{ $attributes->class(['sm:grid-cols-2 md:grid-cols-5']) }}
>
    <x-filament-partials::forms.actions>
        <x-filament-partials::actions.link
            button
            x-on:click="selectAll()"
            x-show="!isSelected()"
        >
            {{ __('Alle auswählen') }}
        </x-filament-partials::actions.link>
    </x-filament-partials::forms.actions>
    @foreach($categories as $name => $label)
    <x-filament-forms::field-wrapper>
        <x-slot:label>{{ $label }}</x-slot:label>
        <x-slot:labelPrefix>
            <x-filament::input.checkbox
                :$name
                :disabled="$name === 'essential'"
                x-bind:checked="isSelected($el.name)"
                x-on:change="toggleAll($el.name)"
            />
        </x-slot:labelPrefix>
    </x-filament-forms::field-wrapper>
    @endforeach
</x-filament-partials::forms.component-container>