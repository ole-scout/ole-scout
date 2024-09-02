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
        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input size="sm" type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button size="sm" intent="primary" icon="save">Speichern</x-ui::input>
        </div>
        <div class="flex w-full gap-2 col-span-full">
            <x-ui::input size="lg" type="text" placeholder="Platzhalter" class="col-span-4" />
            <x-ui::button size="lg" intent="primary" icon="save">Speichern</x-ui::input>
        </div>
        <x-ui::checkbox />
        <x-ui::checkbox checked />
        <x-ui::checkbox disabled />
        <x-ui::checkbox disabled checked />
        <x-ui::radio name="x" value="1" />
        <x-ui::radio name="x" value="2" checked />
        <x-ui::radio name="y" value="1" disabled />
        <x-ui::radio name="y" value="2" disabled checked />
    </div>

    <div class="grid max-w-2xl grid-cols-5 gap-4 p-8 mx-auto bg-gray-100 rounded-lg shadow place-items-center dark:bg-gray-900">
        <x-ui::button>Default</x-ui::button>
        <x-ui::button intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="alt">Default</x-ui::button>
        <x-ui::button intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="ghost">Default</x-ui::button>
        <x-ui::button intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="link">Default</x-ui::button>
        <x-ui::button intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

    <div class="grid max-w-2xl grid-cols-5 gap-4 p-8 mx-auto bg-gray-100 rounded-lg shadow place-items-center dark:bg-gray-900">
        <x-ui::button size="sm">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="alt">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="ghost">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="link">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

    <div class="grid max-w-2xl grid-cols-5 gap-4 p-8 mx-auto bg-gray-100 rounded-lg shadow place-items-center dark:bg-gray-900">
        <x-ui::button size="lg">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="alt">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="ghost">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="link">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

    <div class="grid max-w-2xl grid-cols-5 gap-4 p-8 mx-auto rounded-lg shadow place-items-center bg-gray-50 dark:bg-gray-950">
        <x-ui::button>Default</x-ui::button>
        <x-ui::button intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="alt">Default</x-ui::button>
        <x-ui::button intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="ghost">Default</x-ui::button>
        <x-ui::button intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="link">Default</x-ui::button>
        <x-ui::button intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

    <div class="grid max-w-2xl grid-cols-5 gap-4 p-8 mx-auto rounded-lg shadow place-items-center bg-gray-50 dark:bg-gray-950">
        <x-ui::button size="sm">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="alt">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="ghost">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="link">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

    <div class="grid max-w-2xl grid-cols-5 gap-4 p-8 mx-auto rounded-lg shadow place-items-center bg-gray-50 dark:bg-gray-950">
        <x-ui::button size="lg">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="alt">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="ghost">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="link">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

    <div class="grid max-w-2xl grid-cols-5 gap-4 p-8 mx-auto bg-white rounded-lg shadow place-items-center dark:bg-black">
        <x-ui::button>Default</x-ui::button>
        <x-ui::button intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="alt">Default</x-ui::button>
        <x-ui::button intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="ghost">Default</x-ui::button>
        <x-ui::button intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="link">Default</x-ui::button>
        <x-ui::button intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

    <div class="grid max-w-2xl grid-cols-5 gap-4 p-8 mx-auto bg-white rounded-lg shadow place-items-center dark:bg-black">
        <x-ui::button size="sm">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="alt">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="ghost">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="link">Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="sm" variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button size="sm" intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button size="sm" intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button size="sm" intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button size="sm" disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

    <div class="grid max-w-2xl grid-cols-5 gap-4 p-8 mx-auto bg-white rounded-lg shadow place-items-center dark:bg-black">
        <x-ui::button size="lg">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="alt">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="ghost">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="link">Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button size="lg" variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button size="lg" intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button size="lg" intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button size="lg" intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button size="lg" disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

</div>