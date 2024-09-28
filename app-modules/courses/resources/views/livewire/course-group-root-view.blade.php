<x-slot:title>{{ __('Course overview') }}</x-slot:title>
<x-ui::dialog>
    <x-slot:title>{{ __('Course overview') }}</x-slot:title>
    <x-slot:icon icon="icon-ole-scout" class="circle"></x-slot:icon>
    <div class="grid grid-cols-[repeat(auto-fill,minmax(16rem,1fr))] gap-4">
        @foreach($courseGroups as $group)
        <x-courses::course-group :courseGroup="$group" />
        @endforeach
        @foreach($courses as $course)
        <x-courses::course :course="$course" />
        @endforeach
    </div>
</x-ui::dialog>