 <div class="space-y-4">
    @foreach(['bg-gray-100 dark:bg-gray-900', 'bg-gray-50 dark:bg-gray-950', 'bg-white dark:bg-black'] as $i => $bg)
    @foreach(['sm', 'md', 'lg'] as $size)
    <div class="grid max-w-2xl grid-cols-5 gap-4 p-8 mx-auto rounded-lg shadow place-items-center {{ $bg }}">
        <x-ui::button :$size>Default</x-ui::button>
        <x-ui::button :$size intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button :$size intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button :$size intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button :$size disabled icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button :$size variant="alt">Default</x-ui::button>
        <x-ui::button :$size intent="primary" variant="alt" icon="save">Primary</x-ui::button>
        <x-ui::button :$size intent="danger" variant="alt" icon="warning">Danger</x-ui::button>
        <x-ui::button :$size intent="success" variant="alt" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button :$size disabled variant="alt" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button :$size variant="ghost">Default</x-ui::button>
        <x-ui::button :$size intent="primary" variant="ghost" icon="save">Primary</x-ui::button>
        <x-ui::button :$size intent="danger" variant="ghost" icon="warning">Danger</x-ui::button>
        <x-ui::button :$size intent="success" variant="ghost" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button :$size disabled variant="ghost" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button :$size variant="link">Default</x-ui::button>
        <x-ui::button :$size intent="primary" variant="link" icon="save">Primary</x-ui::button>
        <x-ui::button :$size intent="danger" variant="link" icon="warning">Danger</x-ui::button>
        <x-ui::button :$size intent="success" variant="link" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button :$size disabled variant="link" icon="lock-closed">Disabled</x-ui::button>
        
        <x-ui::button :$size variant="overlay" icon="info" hidden-label>Default</x-ui::button>
        <x-ui::button :$size intent="primary" variant="overlay" icon="save" hidden-label>Primary</x-ui::button>
        <x-ui::button :$size intent="danger" variant="overlay" icon="warning" hidden-label>Danger</x-ui::button>
        <x-ui::button :$size intent="success" variant="overlay" icon="checkmark-circle" hidden-label>Success</x-ui::button>
        <x-ui::button :$size disabled variant="overlay" icon="lock-closed" hidden-label>Disabled</x-ui::button>
    </div>
    @endforeach
    @endforeach
</div>