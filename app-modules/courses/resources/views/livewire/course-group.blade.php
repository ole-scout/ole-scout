@php
    $crumbs = $courseGroup->ancestors()->depthFirst()->get()
        ->mapWithKeys(fn($item) => [route('courses.group', $item) => $item['title']])->toArray();
    $crumbs = array_merge([route('courses.root') => __('Course overview')], $crumbs);
@endphp
<x-slot:title>{{ $courseGroup->title }}</x-slot:title>
<x-slot:crumbs :crumbs="$crumbs"></x-slot:crumbs>
<x-ui::dialog :color="$courseGroup->color">
    <x-slot:title>{{ $courseGroup->title }}</x-slot:title>
    <x-slot:icon :icon="$courseGroup->icon" class="circle"></x-slot:icon>
    <div>slug: {{ $courseGroup->slug }}</div>
    <div class="flex flex-col pl-4 gap-y-1">
        @foreach($courseGroups as $group)
        <x-ui::button :href="route('courses.group', $group)">{{ $group->title }} ({{ $group->courseGroups()->forUser()->count() + $group->courses()->forUser()->count() }})</x-ui::button>
        @endforeach
    </div>
    <div>{{ $courses->count() }} courses:</div>
    <div class="flex flex-col pl-4 gap-y-1">
        @foreach($courses as $course)
        <x-ui::button variant="link" disabled>{{ $course->slug }}: {{ $course->title }} ({{ $course->language }})</x-ui::button>
        @endforeach
    </div>
</x-ui::dialog>