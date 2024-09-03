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

        <x-ui::label :$size icon="warning">Click<x-slot:wrap><x-ui::checkbox :$size /></x-slot:wrap></x-ui::label>
        <x-ui::label :$size iconTrailing="warning">Click<x-slot:wrap><x-ui::checkbox :$size checked /></x-slot:wrap></x-ui::label>
        <x-ui::label :$size icon="warning" trailing>Click<x-slot:wrap><x-ui::checkbox :$size disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label :$size iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::checkbox :$size disabled checked /></x-slot:wrap></x-ui::label>

        <x-ui::label :$size icon="warning">Click<x-slot:wrap><x-ui::radio :$size :name="$size . '-a' . $i" value="1" /></x-slot:wrap></x-ui::label>
        <x-ui::label :$size iconTrailing="warning">Click<x-slot:wrap><x-ui::radio :$size :name="$size . '-a' . $i" value="2" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label :$size icon="warning" trailing>Click<x-slot:wrap><x-ui::radio :$size :name="$size . '-b' . $i" value="1" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label :$size iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::radio :$size :name="$size . '-b' . $i" value="2" disabled checked /></x-slot:wrap></x-ui::label>

        <x-ui::label :$size icon="warning">Click<x-slot:wrap><x-ui::switch :$size /></x-slot:wrap></x-ui::label>
        <x-ui::label :$size iconTrailing="warning">Click<x-slot:wrap><x-ui::switch :$size checked /></x-slot:wrap></x-ui::label>
        <x-ui::label :$size icon="warning" trailing>Click<x-slot:wrap><x-ui::switch :$size disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label :$size iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::switch :$size disabled checked /></x-slot:wrap></x-ui::label>
    </div>
    @endforeach
    @endforeach
</div>