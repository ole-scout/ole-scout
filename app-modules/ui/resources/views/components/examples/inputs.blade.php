<div class="space-y-4">

    <div class="grid max-w-2xl grid-cols-4 gap-4 p-8 mx-auto bg-gray-100 rounded-lg shadow place-items-center dark:bg-gray-900">
        <x-ui::file-picker variant="alt" class="col-span-full">Datei wählen …</x-ui::file-picker>

        <x-ui::input type="text" placeholder="Platzhalter" class="col-span-full" />
        <x-ui::input type="text" value="Textfeld" class="col-span-full" />
        <x-ui::input type="text" value="Textfeld" disabled class="col-span-full" />
        <x-ui::input type="textarea" value="Volltextfeld" class="col-span-full" />

        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button intent="primary" icon="save">Speichern</x-ui::input>
        </div>

        <x-ui::label icon="warning">Click<x-slot:wrap><x-ui::checkbox /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning">Click<x-slot:wrap><x-ui::checkbox checked /></x-slot:wrap></x-ui::label>
        <x-ui::label icon="warning" trailing>Click<x-slot:wrap><x-ui::checkbox disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::checkbox disabled checked /></x-slot:wrap></x-ui::label>

        <x-ui::label icon="warning">Click<x-slot:wrap><x-ui::radio name="md-a" value="1" /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning">Click<x-slot:wrap><x-ui::radio name="md-a" value="2" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label icon="warning" trailing>Click<x-slot:wrap><x-ui::radio name="md-b" value="1" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::radio name="md-b" value="2" disabled checked /></x-slot:wrap></x-ui::label>
    </div>

    <div class="grid max-w-2xl grid-cols-4 gap-4 p-8 mx-auto bg-gray-100 rounded-lg shadow place-items-center dark:bg-gray-900">
        <x-ui::file-picker size="sm" variant="alt" class="col-span-full">Datei wählen …</x-ui::file-picker>

        <x-ui::input size="sm" type="text" placeholder="Platzhalter" class="col-span-full" />
        <x-ui::input size="sm" type="text" value="Textfeld" class="col-span-full" />
        <x-ui::input size="sm" type="text" value="Textfeld" disabled class="col-span-full" />
        <x-ui::input size="sm" type="textarea" value="Volltextfeld" class="col-span-full" />

        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input size="sm" type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button size="sm" intent="primary" icon="save">Speichern</x-ui::input>
        </div>

        <x-ui::label size="sm" icon="warning">Click<x-slot:wrap><x-ui::checkbox size="sm" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" iconTrailing="warning">Click<x-slot:wrap><x-ui::checkbox size="sm" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" icon="warning" trailing>Click<x-slot:wrap><x-ui::checkbox size="sm" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::checkbox size="sm" disabled checked /></x-slot:wrap></x-ui::label>

        <x-ui::label size="sm" icon="warning">Click<x-slot:wrap><x-ui::radio size="sm" name="sm-a" value="1" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" iconTrailing="warning">Click<x-slot:wrap><x-ui::radio size="sm" name="sm-a" value="2" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" icon="warning" trailing>Click<x-slot:wrap><x-ui::radio size="sm" name="sm-b" value="1" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::radio size="sm" name="sm-b" value="2" disabled checked /></x-slot:wrap></x-ui::label>
    </div>

    <div class="grid max-w-2xl grid-cols-4 gap-4 p-8 mx-auto bg-gray-100 rounded-lg shadow place-items-center dark:bg-gray-900">
        <x-ui::file-picker size="lg" variant="alt" class="col-span-full">Datei wählen …</x-ui::file-picker>

        <x-ui::input size="lg" type="text" placeholder="Platzhalter" class="col-span-full" />
        <x-ui::input size="lg" type="text" value="Textfeld" class="col-span-full" />
        <x-ui::input size="lg" type="text" value="Textfeld" disabled class="col-span-full" />
        <x-ui::input size="lg" type="textarea" value="Volltextfeld" class="col-span-full" />

        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input size="lg" type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button size="lg" intent="primary" icon="save">Speichern</x-ui::input>
        </div>

        <x-ui::label size="lg" icon="warning">Click<x-slot:wrap><x-ui::checkbox size="lg" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" iconTrailing="warning">Click<x-slot:wrap><x-ui::checkbox size="lg" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" icon="warning" trailing>Click<x-slot:wrap><x-ui::checkbox size="lg" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::checkbox size="lg" disabled checked /></x-slot:wrap></x-ui::label>

        <x-ui::label size="lg" icon="warning">Click<x-slot:wrap><x-ui::radio size="lg" name="lg-a" value="1" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" iconTrailing="warning">Click<x-slot:wrap><x-ui::radio size="lg" name="lg-a" value="2" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" icon="warning" trailing>Click<x-slot:wrap><x-ui::radio size="lg" name="lg-b" value="1" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::radio size="lg" name="lg-b" value="2" disabled checked /></x-slot:wrap></x-ui::label>
    </div>

    <div class="grid max-w-2xl grid-cols-4 gap-4 p-8 mx-auto rounded-lg shadow bg-gray-50 place-items-center dark:bg-gray-950">
        <x-ui::file-picker variant="alt" class="col-span-full">Datei wählen …</x-ui::file-picker>

        <x-ui::input type="text" placeholder="Platzhalter" class="col-span-full" />
        <x-ui::input type="text" value="Textfeld" class="col-span-full" />
        <x-ui::input type="text" value="Textfeld" disabled class="col-span-full" />
        <x-ui::input type="textarea" value="Volltextfeld" class="col-span-full" />

        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button intent="primary" icon="save">Speichern</x-ui::input>
        </div>

        <x-ui::label icon="warning">Click<x-slot:wrap><x-ui::checkbox /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning">Click<x-slot:wrap><x-ui::checkbox checked /></x-slot:wrap></x-ui::label>
        <x-ui::label icon="warning" trailing>Click<x-slot:wrap><x-ui::checkbox disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::checkbox disabled checked /></x-slot:wrap></x-ui::label>

        <x-ui::label icon="warning">Click<x-slot:wrap><x-ui::radio name="md-a1" value="1" /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning">Click<x-slot:wrap><x-ui::radio name="md-a1" value="2" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label icon="warning" trailing>Click<x-slot:wrap><x-ui::radio name="md-b1" value="1" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::radio name="md-b1" value="2" disabled checked /></x-slot:wrap></x-ui::label>
    </div>

    <div class="grid max-w-2xl grid-cols-4 gap-4 p-8 mx-auto rounded-lg shadow bg-gray-50 place-items-center dark:bg-gray-950">
        <x-ui::file-picker size="sm" variant="alt" class="col-span-full">Datei wählen …</x-ui::file-picker>

        <x-ui::input size="sm" type="text" placeholder="Platzhalter" class="col-span-full" />
        <x-ui::input size="sm" type="text" value="Textfeld" class="col-span-full" />
        <x-ui::input size="sm" type="text" value="Textfeld" disabled class="col-span-full" />
        <x-ui::input size="sm" type="textarea" value="Volltextfeld" class="col-span-full" />

        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input size="sm" type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button size="sm" intent="primary" icon="save">Speichern</x-ui::input>
        </div>

        <x-ui::label size="sm" icon="warning">Click<x-slot:wrap><x-ui::checkbox size="sm" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" iconTrailing="warning">Click<x-slot:wrap><x-ui::checkbox size="sm" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" icon="warning" trailing>Click<x-slot:wrap><x-ui::checkbox size="sm" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::checkbox size="sm" disabled checked /></x-slot:wrap></x-ui::label>

        <x-ui::label size="sm" icon="warning">Click<x-slot:wrap><x-ui::radio size="sm" name="sm-a1" value="1" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" iconTrailing="warning">Click<x-slot:wrap><x-ui::radio size="sm" name="sm-a1" value="2" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" icon="warning" trailing>Click<x-slot:wrap><x-ui::radio size="sm" name="sm-b1" value="1" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::radio size="sm" name="sm-b1" value="2" disabled checked /></x-slot:wrap></x-ui::label>
    </div>

    <div class="grid max-w-2xl grid-cols-4 gap-4 p-8 mx-auto rounded-lg shadow bg-gray-50 place-items-center dark:bg-gray-950">
        <x-ui::file-picker size="lg" variant="alt" class="col-span-full">Datei wählen …</x-ui::file-picker>

        <x-ui::input size="lg" type="text" placeholder="Platzhalter" class="col-span-full" />
        <x-ui::input size="lg" type="text" value="Textfeld" class="col-span-full" />
        <x-ui::input size="lg" type="text" value="Textfeld" disabled class="col-span-full" />
        <x-ui::input size="lg" type="textarea" value="Volltextfeld" class="col-span-full" />

        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input size="lg" type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button size="lg" intent="primary" icon="save">Speichern</x-ui::input>
        </div>

        <x-ui::label size="lg" icon="warning">Click<x-slot:wrap><x-ui::checkbox size="lg" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" iconTrailing="warning">Click<x-slot:wrap><x-ui::checkbox size="lg" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" icon="warning" trailing>Click<x-slot:wrap><x-ui::checkbox size="lg" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::checkbox size="lg" disabled checked /></x-slot:wrap></x-ui::label>

        <x-ui::label size="lg" icon="warning">Click<x-slot:wrap><x-ui::radio size="lg" name="lg-a1" value="1" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" iconTrailing="warning">Click<x-slot:wrap><x-ui::radio size="lg" name="lg-a1" value="2" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" icon="warning" trailing>Click<x-slot:wrap><x-ui::radio size="lg" name="lg-b1" value="1" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::radio size="lg" name="lg-b1" value="2" disabled checked /></x-slot:wrap></x-ui::label>
    </div>

    <div class="grid max-w-2xl grid-cols-4 gap-4 p-8 mx-auto bg-white rounded-lg shadow place-items-center dark:bg-black">
        <x-ui::file-picker variant="alt" class="col-span-full">Datei wählen …</x-ui::file-picker>

        <x-ui::input type="text" placeholder="Platzhalter" class="col-span-full" />
        <x-ui::input type="text" value="Textfeld" class="col-span-full" />
        <x-ui::input type="text" value="Textfeld" disabled class="col-span-full" />
        <x-ui::input type="textarea" value="Volltextfeld" class="col-span-full" />

        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button intent="primary" icon="save">Speichern</x-ui::input>
        </div>

        <x-ui::label icon="warning">Click<x-slot:wrap><x-ui::checkbox /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning">Click<x-slot:wrap><x-ui::checkbox checked /></x-slot:wrap></x-ui::label>
        <x-ui::label icon="warning" trailing>Click<x-slot:wrap><x-ui::checkbox disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::checkbox disabled checked /></x-slot:wrap></x-ui::label>

        <x-ui::label icon="warning">Click<x-slot:wrap><x-ui::radio name="md-a2" value="1" /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning">Click<x-slot:wrap><x-ui::radio name="md-a2" value="2" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label icon="warning" trailing>Click<x-slot:wrap><x-ui::radio name="md-b2" value="1" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::radio name="md-b2" value="2" disabled checked /></x-slot:wrap></x-ui::label>
    </div>

    <div class="grid max-w-2xl grid-cols-4 gap-4 p-8 mx-auto bg-white rounded-lg shadow place-items-center dark:bg-black">
        <x-ui::file-picker size="sm" variant="alt" class="col-span-full">Datei wählen …</x-ui::file-picker>

        <x-ui::input size="sm" type="text" placeholder="Platzhalter" class="col-span-full" />
        <x-ui::input size="sm" type="text" value="Textfeld" class="col-span-full" />
        <x-ui::input size="sm" type="text" value="Textfeld" disabled class="col-span-full" />
        <x-ui::input size="sm" type="textarea" value="Volltextfeld" class="col-span-full" />

        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input size="sm" type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button size="sm" intent="primary" icon="save">Speichern</x-ui::input>
        </div>

        <x-ui::label size="sm">Click<x-slot:wrap><x-ui::checkbox size="sm" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm">Click<x-slot:wrap><x-ui::checkbox size="sm" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm">Click<x-slot:wrap><x-ui::checkbox size="sm" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm">Click<x-slot:wrap><x-ui::checkbox size="sm" disabled checked /></x-slot:wrap></x-ui::label>

        <x-ui::label size="sm" icon="warning">Click<x-slot:wrap><x-ui::radio size="sm" name="sm-a2" value="1" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" iconTrailing="warning">Click<x-slot:wrap><x-ui::radio size="sm" name="sm-a2" value="2" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" icon="warning" trailing>Click<x-slot:wrap><x-ui::radio size="sm" name="sm-b2" value="1" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="sm" iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::radio size="sm" name="sm-b2" value="2" disabled checked /></x-slot:wrap></x-ui::label>
    </div>

    <div class="grid max-w-2xl grid-cols-4 gap-4 p-8 mx-auto bg-white rounded-lg shadow place-items-center dark:bg-black">
        <x-ui::file-picker size="lg" variant="alt" class="col-span-full">Datei wählen …</x-ui::file-picker>

        <x-ui::input size="lg" type="text" placeholder="Platzhalter" class="col-span-full" />
        <x-ui::input size="lg" type="text" value="Textfeld" class="col-span-full" />
        <x-ui::input size="lg" type="text" value="Textfeld" disabled class="col-span-full" />
        <x-ui::input size="lg" type="textarea" value="Volltextfeld" class="col-span-full" />

        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input size="lg" type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button size="lg" intent="primary" icon="save">Speichern</x-ui::input>
        </div>

        <x-ui::label size="lg">Click<x-slot:wrap><x-ui::checkbox size="lg" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg">Click<x-slot:wrap><x-ui::checkbox size="lg" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg">Click<x-slot:wrap><x-ui::checkbox size="lg" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg">Click<x-slot:wrap><x-ui::checkbox size="lg" disabled checked /></x-slot:wrap></x-ui::label>

        <x-ui::label size="lg" icon="warning">Click<x-slot:wrap><x-ui::radio size="lg" name="lg-a2" value="1" /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" iconTrailing="warning">Click<x-slot:wrap><x-ui::radio size="lg" name="lg-a2" value="2" checked /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" icon="warning" trailing>Click<x-slot:wrap><x-ui::radio size="lg" name="lg-b2" value="1" disabled /></x-slot:wrap></x-ui::label>
        <x-ui::label size="lg" iconTrailing="warning" trailing>Click<x-slot:wrap><x-ui::radio size="lg" name="lg-b2" value="2" disabled checked /></x-slot:wrap></x-ui::label>
    </div>

</div>