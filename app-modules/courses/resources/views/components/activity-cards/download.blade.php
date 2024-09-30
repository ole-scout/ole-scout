@props([
    'activity',
])
<x-core-ui::card
    :title="$activity->title"
    :color="$activity->course->color"
    icon="heroicon-c-arrow-down-tray"
    :style="$activity->content->image ? '--background-image: url(\'' . $activity->content->image . '\')' : null"
    :footer="true"
>
@if($activity->content->image)
<img src="{{ $activity->content->image }}" class="preview" aria-hidden="true" />
@endif
@if($activity->description)
<div class="description">{{ $activity->description }}</div>
@endif
<x-slot:actions>
    <x-ui::button :href="route('courses.activity.download', [$activity->course, $activity])" variant="alt" :download="$activity->content->filename">
        {{ __('Download') }}
    </x-ui::button>
</x-slot:actions>
</x-core-ui::card>