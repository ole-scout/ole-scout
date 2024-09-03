@php
    $asAttributes = fn (array $attributes) => new \Illuminate\View\ComponentAttributeBag($attributes);
    $toggleAttributeTuples = [
        [['icon' => 'warning'], []],
        [['iconTrailing' => 'warning'], ['checked' => true]],
        [['icon' => 'warning', 'trailing' => true], ['disabled' => true]],
        [['iconTrailing' => 'warning', 'trailing' => true], ['checked' => true, 'disabled' => true]],
    ];
@endphp
<div class="space-y-4">
    @foreach(['bg-gray-100 dark:bg-gray-900', 'bg-gray-50 dark:bg-gray-950', 'bg-white dark:bg-black'] as $i => $bg)
    @foreach(['sm', 'md', 'lg'] as $size)
    <div class="grid max-w-2xl grid-cols-4 gap-4 p-8 mx-auto rounded-lg shadow place-items-center {{ $bg }}">
        <x-ui::file-picker :$size variant="alt" class="col-span-full">Datei wählen …</x-ui::file-picker>

        <x-ui::input :$size type="text" placeholder="Platzhalter" class="col-span-full" />
        <x-ui::input :$size type="text" value="Textfeld" class="col-span-full" />
        <x-ui::input :$size type="text" value="Textfeld" disabled class="col-span-full" />
        <x-ui::input :$size type="textarea" value="Volltextfeld" class="col-span-full" />

        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input :$size type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button :$size intent="primary" icon="save">Speichern</x-ui::input>
        </div>

        @foreach($toggleAttributeTuples as [$labelAttributes, $inputAttributes])
        <x-ui::label :$size :attributes="$asAttributes($labelAttributes)">Click<x-slot:wrap><x-ui::checkbox :$size :attributes="$asAttributes($inputAttributes)" /></x-slot:wrap></x-ui::label>
        @endforeach

        @foreach($toggleAttributeTuples as $j => [$labelAttributes, $inputAttributes])
        <x-ui::label :$size :attributes="$asAttributes($labelAttributes)">Click<x-slot:wrap><x-ui::radio :$size :name="join('-', [$size, $i, floor($j / 2)])" :value="strval($j % 2)" :attributes="$asAttributes($inputAttributes)" /></x-slot:wrap></x-ui::label>
        @endforeach

        @foreach($toggleAttributeTuples as [$labelAttributes, $inputAttributes])
        <x-ui::label :$size :attributes="$asAttributes($labelAttributes)">Click<x-slot:wrap><x-ui::switch :$size :attributes="$asAttributes($inputAttributes)" /></x-slot:wrap></x-ui::label>
        @endforeach
    </div>
    @endforeach
    @endforeach
</div>