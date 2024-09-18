@props([
    'categories' => [],
])
<div {{ $attributes->class(['flex gap-4 flex-wrap sm:justify-around items-center lg:grid lg:grid-cols-5']) }}>
    <div class="flex items-center h-full">
        <x-ui::button
            variant="link"
            x-on:click="toggle()"
        >
            <span x-show="!isAllSelected()">{{ __('Alle auswählen') }}</span>
            <span x-show="isAllSelected()" x-cloak>{{ __('Auswahl aufheben') }}</span>
        </x-ui::button>
    </div>
    @foreach($categories as $name => $label)
    <x-ui::field
        :$name
        :$label
        inline>
        <x-slot:input
            component="ui::checkbox"
            x-bind:checked="isAllSelected($el.name)"
            x-ui-indeterminate="!isAllSelected($el.name) && isSelected($el.name)"
            x-on:change="toggleAll($el.name)"
            :disabled="$name === 'essential'"
        ></x-slot:input>
    </x-ui::field>
    @endforeach
</div>