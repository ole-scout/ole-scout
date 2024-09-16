@props([
    'categories' => [],
])
<div {{ $attributes->class(['flex gap-4 flex-wrap sm:justify-around items-center lg:grid lg:grid-cols-5']) }}>
    <div class="flex items-center h-full">
        <x-ui::button
            variant="link"
            x-on:click="selectAll()"
            x-show="!isSelected()"
        >{{ __('Alle auswählen') }}</x-ui::button>
    </div>
    @foreach($categories as $name => $label)
    <x-ui::field
        :$name
        :$label
        :disabled="$name === 'essential'"
        inline>
        <x-slot:input
            component="ui::checkbox"
            x-bind:checked="isSelected($el.name)"
            x-on:change="toggleAll($el.name)"
        ></x-slot:input>
    </x-ui::field>
    @endforeach
</div>