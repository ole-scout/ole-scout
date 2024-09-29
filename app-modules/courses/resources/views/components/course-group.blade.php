@props([
    'courseGroup',
])
<x-core-ui::card
    :color="$courseGroup->color"
    :icon="$courseGroup->icon"
    :slug="$courseGroup->slug"
    :title="$courseGroup->title"
    :count="$courseGroup->recursiveCourses->count()"
>
    <x-slot:actions>
        <x-ui::button :href="route('courses.group', $courseGroup)" variant="alt">
            {{ __('View contents') }}
        </x-ui::button>
    </x-slot:actions>
    <x-core-ui::card.course-list
        :courses="$courseGroup->recursiveCourses"
    />
</x-core-ui::card>