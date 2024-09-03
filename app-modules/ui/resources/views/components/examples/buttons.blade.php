 <div class="space-y-4">
    @foreach(['sm', 'md', 'lg'] as $size)
    @foreach(['bg-gray-100 dark:bg-gray-900', 'bg-gray-50 dark:bg-gray-950', 'bg-white dark:bg-black'] as $i => $bg)
    <div class="grid {{ match($size) {
        'sm' => 'max-w-xl',
        'md' => 'max-w-2xl',
        'lg' => 'max-w-3xl',
    } }} grid-cols-5 gap-4 p-8 mx-auto rounded-lg shadow place-items-center {{ $bg }}">
        @foreach([null, 'alt', 'ghost', 'link', 'overlay'] as $variant)
        @php
            $hiddenLabel = $variant === 'overlay';
        @endphp
        <x-ui::button :$size :$variant :$hiddenLabel :icon="$hiddenLabel ? 'info' : null">Default</x-ui::button>
        <x-ui::button :$size :$variant :$hiddenLabel intent="primary" icon="save">Primary</x-ui::button>
        <x-ui::button :$size :$variant :$hiddenLabel intent="danger" icon="warning">Danger</x-ui::button>
        <x-ui::button :$size :$variant :$hiddenLabel intent="success" icon="checkmark-circle">Success</x-ui::button>
        <x-ui::button :$size :$variant :$hiddenLabel disabled icon="lock-closed">Disabled</x-ui::button>
        @endforeach
    </div>
    @endforeach
    @endforeach
</div>