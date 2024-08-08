@props([
    'tablist' => null,
])
<div {{ $attributes->class(['flex flex-col bg-white shadow-sm fi-fo-tabs fi-contained rounded-xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10']) }}>
    <x-filament::tabs contained>
        {{ $tablist }}
    </x-filament::tabs>
    {{ $slot }}
</div>