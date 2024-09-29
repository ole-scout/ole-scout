@php
    $crumbs = $courseGroup->ancestors()->depthFirst()->get()
        ->mapWithKeys(fn($item) => [route('courses.group', $item) => $item['title']])->toArray();
    $crumbs = array_merge([route('courses.root') => __('Course overview')], $crumbs);
@endphp
<x-slot:title>{{ $courseGroup->title }}</x-slot:title>
<x-slot:crumbs :crumbs="$crumbs"></x-slot:crumbs>
<x-ui::dialog :color="$courseGroup->color">
    <x-slot:title class="flex flex-row items-center justify-between">
        <div class="flex-shrink-0">{{ $courseGroup->title }}</div>
        <div class="flex-shrink-0 text-sm font-semibold">{{ $courseGroup->slug }}</div>
    </x-slot:title>
    <x-slot:icon :icon="$courseGroup->icon" class="circle"></x-slot:icon>
    @if($courseGroups->count() > 3 || $courseGroups->some(fn($group) => $group->courseGroups->isNotEmpty()))
    <div class="grid grid-cols-[repeat(auto-fill,minmax(16rem,1fr))] gap-4">
        @foreach($courseGroups as $group)
        <x-courses::course-group :courseGroup="$group" />
        @endforeach
        @foreach($courses as $course)
        <x-courses::course :course="$course" />
        @endforeach
    </div>
    @else
    <div class="flex flex-col gap-8">
        @if($courses->isNotEmpty())
        <div class="grid grid-cols-[repeat(auto-fill,minmax(16rem,1fr))] gap-4 w-full">
            @foreach($courses as $course)
            <x-courses::course :course="$course" />
            @endforeach
        </div>
        @endif
        @foreach($courseGroups as $group)
        <x-ui::dialog.collapsible :color="$group->color">
            <x-slot:icon :icon="$group->icon" class="circle"></x-slot:icon>
            <x-slot:slot class="grid grid-cols-[repeat(auto-fill,minmax(16rem,1fr))] gap-4">
                @foreach($group->courses as $course)
                <x-courses::course :course="$course" />
                @endforeach
            </x-slot:slot>
            <x-slot:title class="flex flex-row items-center justify-between">
            <div class="flex-shrink-0">{{ $group->title }}</div>
            <div class="flex-shrink-0 text-sm font-semibold">{{ $group->slug }}</div>
            </x-slot:title>
        </x-ui::dialog.collapsible>
        @endforeach
    </div>
    @endif
</x-ui::dialog>