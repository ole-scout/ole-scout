<x-slot:title>{{ $courseGroup->title }}</x-slot:title>
<x-slot:parent :href="$courseGroup->parent ? route('courses.group', $courseGroup->parent) : route('courses.root')">{{ $courseGroup->parent ? $courseGroup->parent->title : __('Course overview') }}</x-slot:parent>
<x-slot:icon :icon="$courseGroup->icon"></x-slot:icon>
<div>
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
</div>