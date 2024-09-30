@props([
    'activity',
])
<x-core-ui::card
    :title="$activity->title"
    :color="$activity->course->color"
    icon="heroicon-c-link"
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
    <x-ui::button :href="route('courses.activity.weblink', [$activity->course, $activity])" variant="alt">
        {{ __('Open link') }}
    </x-ui::button>
</x-slot:actions>
</x-core-ui::card>