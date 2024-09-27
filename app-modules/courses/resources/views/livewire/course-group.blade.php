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
    <div class="grid grid-cols-[repeat(auto-fill,minmax(16rem,1fr))] gap-4">
        @foreach($courseGroups as $group)
        <x-courses::course-group :group="$group" />
        @endforeach
        @foreach($courses as $course)
        <x-courses::course :course="$course" />
        @endforeach
    </div>
</x-ui::dialog>