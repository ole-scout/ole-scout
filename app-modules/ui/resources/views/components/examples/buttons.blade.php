 <div class="space-y-4">

    <div class="grid max-w-xl grid-cols-4 gap-4 p-8 mx-auto text-sm bg-gray-100 rounded-lg shadow place-items-center dark:bg-gray-900">
        <x-ui::file-picker variant="alt" class="col-span-full">Datei wählen …</x-ui::file-picker>
        <x-ui::checkbox />
        <x-ui::checkbox checked />
        <x-ui::checkbox disabled />
        <x-ui::checkbox disabled checked />
        <x-ui::radio name="x" value="1" />
        <x-ui::radio name="x" value="2" checked />
        <x-ui::radio name="y" value="1" disabled />
        <x-ui::radio name="y" value="2" disabled checked />
    </div>

    <div class="grid max-w-xl grid-cols-5 gap-4 p-8 mx-auto text-sm bg-gray-100 rounded-lg shadow place-items-center dark:bg-gray-900">
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

    <div class="grid max-w-xl grid-cols-5 gap-4 p-8 mx-auto text-sm bg-gray-100 rounded-lg shadow place-items-center dark:bg-gray-900">
        <x-ui::button small>Default</x-ui::button>
        <x-ui::button small intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="alt">Default</x-ui::button>
        <x-ui::button small intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="ghost">Default</x-ui::button>
        <x-ui::button small intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="link">Default</x-ui::button>
        <x-ui::button small intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button small intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button small intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button small disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

    <div class="grid max-w-xl grid-cols-5 gap-4 p-8 mx-auto text-sm rounded-lg shadow place-items-center bg-gray-50 dark:bg-gray-950">
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

    <div class="grid max-w-xl grid-cols-5 gap-4 p-8 mx-auto text-sm rounded-lg shadow place-items-center bg-gray-50 dark:bg-gray-950">
        <x-ui::button small>Default</x-ui::button>
        <x-ui::button small intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="alt">Default</x-ui::button>
        <x-ui::button small intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="ghost">Default</x-ui::button>
        <x-ui::button small intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="link">Default</x-ui::button>
        <x-ui::button small intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button small intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button small intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button small disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

    <div class="grid max-w-xl grid-cols-5 gap-4 p-8 mx-auto text-sm bg-white rounded-lg shadow place-items-center dark:bg-black">
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

    <div class="grid max-w-xl grid-cols-5 gap-4 p-8 mx-auto text-sm bg-white rounded-lg shadow place-items-center dark:bg-black">
        <x-ui::button small>Default</x-ui::button>
        <x-ui::button small intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="alt">Default</x-ui::button>
        <x-ui::button small intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="ghost">Default</x-ui::button>
        <x-ui::button small intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="link">Default</x-ui::button>
        <x-ui::button small intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button small intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button small disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button small variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button small intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button small intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button small intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button small disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>

</div>