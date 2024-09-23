<x-slot:title>{{ __('Course overview') }}</x-slot:title>
<x-slot:icon icon="icon-ole-scout" class="circle"></x-slot:icon>
<div>
    <div class="flex flex-col pl-4 gap-y-1">
        @foreach($courseGroups as $group)
        <x-ui::button :href="route('courses.group', $group)">{{ $group->title }}</x-ui::button>
        @endforeach
    </div>
    <div>{{ $courses->count() }} courses:</div>
    <div class="flex flex-col pl-4 gap-y-1">
        @foreach($courses as $course)
        <x-ui::button variant="link" disabled>{{ $course->slug }}: {{ $course->title }} ({{ $course->language }})</x-ui::button>
        @endforeach
    </div>
</div>