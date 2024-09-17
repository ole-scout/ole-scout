 <div class="my-8 space-y-8">
    @foreach([0,1,2] as $i)
    @foreach(['sm', 'md', 'lg'] as $size)
    <x-ui::card :layer="$i + 1">
        <div class="grid {{ match($size) {
            'sm' => 'max-w-xl',
            'md' => 'max-w-2xl',
            'lg' => 'max-w-4xl',
        } }} grid-cols-5 gap-4 mx-auto place-items-center">
            @foreach([null, 'alt', 'ghost', 'link', 'overlay'] as $variant)
            @php
                $hiddenLabel = $variant === 'overlay';
            @endphp
            <x-ui::button :$size :$variant :$hiddenLabel :icon="$hiddenLabel ? ':info' : null">Default</x-ui::button>
            <x-ui::button :$size :$variant :$hiddenLabel intent="primary" icon=":save">Primary</x-ui::button>
            <x-ui::button :$size :$variant :$hiddenLabel intent="danger" icon=":warning">Danger</x-ui::button>
            <x-ui::button :$size :$variant :$hiddenLabel intent="success" icon="checkmark-circle">Success</x-ui::button>
            <x-ui::button :$size :$variant :$hiddenLabel disabled icon=":lock-closed">Disabled</x-ui::button>
            @endforeach
            @foreach(['normal', 'alt', 'ghost', 'link', 'overlay'] as $variant)
            <x-ui::button :$size :$variant :hiddenLabel="$variant === 'overlay'" icon=":globe" href="#" target="_blank" rel="noopner noreferrer">Link</x-ui::button>
            @endforeach
        </div>
    </x-ui::card>
    @endforeach
    @endforeach
</div>