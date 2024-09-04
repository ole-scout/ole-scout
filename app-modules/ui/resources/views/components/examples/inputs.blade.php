@php
    $asAttributes = fn (array $array) => $attributes->only([])->merge($array);
    $toggleAttributeTuples = [
        [[], ['required' => true]],
        [['icon' => 'warning'], []],
        [['iconTrailing' => 'warning'], ['checked' => true]],
        [[], ['required' => true, 'disabled' => true]],
        [['icon' => 'warning', 'trailing' => true], ['disabled' => true]],
        [['iconTrailing' => 'warning', 'trailing' => true], ['checked' => true, 'disabled' => true]],
    ];
@endphp
<div class="space-y-4">
    @foreach(['bg-gray-100 dark:bg-gray-900', 'bg-gray-50 dark:bg-gray-950', 'bg-white dark:bg-black'] as $i => $bg)
    @foreach(['sm', 'md', 'lg'] as $size)
    <div class="grid  {{ match($size) {
        'sm' => 'max-w-xl',
        'md' => 'max-w-2xl',
        'lg' => 'max-w-3xl',
    } }} grid-cols-6 gap-4 p-8 mx-auto rounded-lg shadow place-items-center {{ $bg }}">
        <x-ui::file-picker :$size variant="alt" class="col-span-full">Choose file …</x-ui::file-picker>

        <x-ui::input :$size type="text" placeholder="Placeholder" class="col-span-full" />
        <x-ui::input :$size type="text" value="Invalid" pattern="\d+" class="col-span-full" />
        <x-ui::input :$size type="text" value="Text field" class="col-span-full" />
        <x-ui::input :$size type="text" value="Text field" disabled class="col-span-full" />
        <x-ui::input :$size type="textarea" value="Text area" class="col-span-full" />
        <x-ui::input :$size type="text" placeholder="Search" class="col-span-full"><x-slot:actionTrailing><x-ui::button :$size variant="link">Search</x-ui::button></x-slot:actionTrailing></x-ui::input>
        <x-ui::input :$size type="text" placeholder="Search" class="col-span-full"><x-slot:actionTrailing><x-ui::button :$size variant="alt" icon="search" hiddenLabel>Search</x-ui::button></x-slot:actionTrailing></x-ui::input>
        <x-ui::input :$size type="text" placeholder="Search" class="col-span-full"><x-slot:action><x-ui::button :$size variant="ghost" icon="search" hiddenLabel>Search</x-ui::button></x-slot:action></x-ui::input>
        <x-ui::input :$size type="text" placeholder="Search" class="col-span-full"><x-slot:actionTrailing><x-ui::button :$size icon="search" hiddenLabel>Search</x-ui::button></x-slot:actionTrailing></x-ui::input>
        <x-ui::input :$size type="text" placeholder="Search" class="col-span-full"><x-slot:actionTrailing><x-ui::button :$size intent="primary" icon="search" hiddenLabel>Search</x-ui::button></x-slot:actionTrailing></x-ui::input>

        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input :$size type="text" placeholder="Placeholder" class="col-span-4" />
            <x-ui::button :$size intent="primary" icon="save">Save</x-ui::input>
        </div>

        @foreach($toggleAttributeTuples as [$labelAttributes, $inputAttributes])
        <x-ui::label :$size :attributes="$asAttributes($labelAttributes)">Click<x-slot:wrap><x-ui::checkbox wrapped :$size :attributes="$asAttributes($inputAttributes)" /></x-slot:wrap></x-ui::label>
        @endforeach

        @foreach($toggleAttributeTuples as $j => [$labelAttributes, $inputAttributes])
        <x-ui::label :$size :attributes="$asAttributes($labelAttributes)">Click<x-slot:wrap><x-ui::radio wrapped :$size :name="join('-', [$size, $i, floor($j / 2)])" :value="strval($j % 2)" :attributes="$asAttributes($inputAttributes)" /></x-slot:wrap></x-ui::label>
        @endforeach

        @foreach($toggleAttributeTuples as [$labelAttributes, $inputAttributes])
        <x-ui::label :$size :attributes="$asAttributes($labelAttributes)">Click<x-slot:wrap><x-ui::switch wrapped :$size :attributes="$asAttributes($inputAttributes)" /></x-slot:wrap></x-ui::label>
        @endforeach
    </div>
    @endforeach
    @endforeach
</div>