@props([
    'course',
])
<x-core-ui::card
    :color="$course->color"
    :icon="$course->icon"
    :slug="$course->slug"
    :title="$course->title"
>
    @if($course->enrollments->isNotEmpty() && $course->enrollments->first()->expires_at !== null)
    <x-slot:flag :class="$course->enrollments->first()->expires_at < now()->addDays(1) ? 'urgent' : ''">
    {{ $course->enrollments->first()->expiration_for_humans }}
    </x-slot:flag>
    @endif
    <x-slot:actions>
        <x-ui::button :href="route('courses.course', $course)" variant="alt">
            {{ __('View contents') }}
        </x-ui::button>
    </x-slot:actions>
</x-core-ui::card>