@props([
    'course',
])
<x-core-ui::card
    :color="$course->color"
    :icon="$course->icon"
    :slug="$course->slug"
    :title="$course->title"
>
    <x-slot:actions>
        <x-ui::button :href="route('courses.course', $course)" variant="alt">
            {{ __('View contents') }}
        </x-ui::button>
    </x-slot:actions>
</x-core-ui::card>