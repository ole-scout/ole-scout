@php
    if ($course->courseGroup) {
        $crumbs = $course->courseGroup->ancestorsAndSelf()->depthFirst()->get()
            ->mapWithKeys(fn($item) => [route('courses.group', $item) => $item['title']])->toArray();
        $crumbs = array_merge([route('courses.root') => __('Course overview')], $crumbs);
    } else {
        $crumbs = [];
    }
@endphp
@capture($render, $group, $recurse)
<x-ui::section.collapsible :label="$group->title">
    <x-slot:slot class="flex flex-col gap-4">
        <div class="grid grid-cols-[repeat(auto-fill,minmax(16rem,1fr))] gap-4">
            @foreach($group->activities as $activity)
            {{ $activity->content->renderCard() }}
            @endforeach
        </div>
        @foreach($group->activityGroups as $group)
        {{ $recurse($group, $recurse) }}
        @endforeach
    </x-slot:slot>
</x-ui::section.collapsible>
@endcapture
<x-slot:title>{{ $course->title }}</x-slot:title>
<x-slot:crumbs :crumbs="$crumbs"></x-slot:crumbs>
<x-ui::dialog :color="$course->color">
    <x-slot:title class="flex flex-row items-center justify-between">
        <div class="flex-shrink-0">{{ $course->title }}</div>
        <div class="flex-shrink-0 text-xs font-semibold uppercase">{{ $course->slug }}</div>
    </x-slot:title>
    <x-slot:icon :icon="$course->icon" class="circle"></x-slot:icon>
    <x-slot:slot class="flex flex-col gap-4">
        @if($activities->count())
        <div class="grid grid-cols-[repeat(auto-fill,minmax(16rem,1fr))] gap-4">
            @foreach($activities as $activity)
            {{ $activity->content->renderCard() }}
            @endforeach
        </div>
        @endif
        @foreach($activityGroups as $group)
        {{ $render($group, $render) }}
        @endforeach
    </x-slot:slot>
</x-ui::dialog>