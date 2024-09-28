@php
    if ($course->courseGroup) {
        $crumbs = $course->courseGroup->ancestorsAndSelf()->depthFirst()->get()
            ->mapWithKeys(fn($item) => [route('courses.group', $item) => $item['title']])->toArray();
        $crumbs = array_merge([route('courses.root') => __('Course overview')], $crumbs);
    } else {
        $crumbs = [];
    }
    $activitiesByGroup = $activities->groupBy('activity_group_id')->map(
        fn($group) => $group->map(function ($activity) {
            $activity->content->activity = $activity;
            $content = $activity->content;
            unset($activity->content);
            return $content;
        })
    );
@endphp
<x-slot:title>{{ $course->title }}</x-slot:title>
<x-slot:crumbs :crumbs="$crumbs"></x-slot:crumbs>
<x-ui::dialog :color="$course->color">
    <x-slot:title>{{ $course->title }}</x-slot:title>
    <x-slot:icon :icon="$course->icon" class="circle"></x-slot:icon>
    <div class="flex flex-col gap-4">
        @if($activitiesByGroup->get(null))
        <div class="grid grid-cols-[repeat(auto-fill,minmax(16rem,1fr))] gap-4">
            @foreach($activitiesByGroup->get(null) as $content)
            {{ $content->renderCard() }}
            @endforeach
        </div>
        @endif
        @foreach($activityGroups as $group)
        <x-ui::section.collapsible :label="$group->title">
            <x-slot:slot class="grid grid-cols-[repeat(auto-fill,minmax(16rem,1fr))] gap-4">
                @if($activitiesByGroup->get($group->id))
                @foreach($activitiesByGroup->get($group->id) as $content)
                {{ $content->renderCard() }}
                @endforeach
                @endif
            </x-slot:slot>
        </x-ui::section.collapsible>
        @endforeach
    </div>
</x-ui::dialog>