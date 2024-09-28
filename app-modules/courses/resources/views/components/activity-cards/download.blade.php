<x-core-ui::card
    :title="$activity->title"
    :color="$course->color"
    icon="heroicon-c-arrow-down-tray"
>
@if($content->image)
<img src="{{ $content->image }}" class="preview" aria-hidden="true" />
@endif
@if($activity->description)
<div class="description">{{ $activity->description }}</div>
@endif
<x-slot:actions>
    <x-ui::button :href="$content->url" variant="alt" :download="$content->filename">
        {{ __('Download') }}
    </x-ui::button>
</x-slot:actions>
</x-core-ui::card>