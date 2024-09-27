@props([
    'group',
])
@php
    $shades = \Filament\Support\Colors\Color::hex($group->color);
    foreach ($shades as $shade => $color) {
        $styles[] = "--c-{$shade}:{$color}";
    }
    $style = implode(';', $styles);
@endphp
<x-ui::card :layer="3" class="relative flex flex-col items-stretch pb-4 min-h-[28rem] isolate max-w-[18rem]" :$style>
    <div class="rounded-t-lg flex-shrink-0 w-full h-24 bg-opacity-50 saturate-[.8] bg-custom-500 dark:bg-custom-900">
    </div>
    <div class="relative flex justify-center -mt-20">
        <div class="p-4 overflow-hidden text-white border border-white rounded-full bg-custom-500 size-24 dark:border-gray-800">
            <x-ui::icon :icon="$group->icon" class="size-full" />
        </div>
        <div class="absolute right-50% mr-[-4rem] overflow-hidden bg-white dark:bg-black border border-white dark:border-gray-800 rounded-full bottom-1 size-6">
            <div class="flex items-center justify-center h-full text-xs bg-opacity-50 saturate-[.8] bg-custom-500 dark:bg-custom-900">{{ $group->recursiveCourses->count() }}</div>
        </div>
    </div>
    <div class="absolute font-bold uppercase text-2xs top-4 left-4">
    {{ $group->slug }}
    </div>
    <div class="box-content flex items-center justify-center flex-shrink-0 py-1 mx-6 my-px overflow-hidden text-sm font-semibold leading-tight text-center min-h-12">{{ $group->title }}</div>
    <div class="flex flex-col flex-grow px-6 mt-4 space-y-2">
        <div class="text-xs">
            {{ trans_choice('This category contains one course:|This category contains :count courses:', $group->recursiveCourses->count()) }}
        </div>
        <div class="grid grid-cols-[4rem,1fr] gap-1 items-center">
            @php
                $limit = 7;
                $hidden = $group->recursiveCourses->count() - $limit;
                if ($hidden === 1) {
                    $limit += $hidden;
                    $hidden = 0;
                }
            @endphp
            @foreach($group->recursiveCourses->take($limit) as $course)
            <div class="font-semibold uppercase truncate text-2xs cursor-help" title="{{ $course->title }}">{{ $course->slug }}</div>
            @php
                $progress = ceil(min(1, strlen($course->title) / 75) * 100); // TODO
            @endphp
            <div class="h-2 bg-gray-200">
                <div class="h-full bg-orange-500 cursor-help" style="width: {{ $progress }}%" title="{{ $progress }} %" aria-hidden="true"></div>
                <div class="sr-only" x-id="['progress']" x-data>
                    <div x-bind:id="$id('progress')">{{ $course->title }}</div>
                    <progress x-bind:aria-labelled-by="$id('progress')" value="{{ $progress }}" max="100">{{ $progress }}%</progress>
                </div>
            </div>
            @endforeach
            @if($hidden > 0)
            <div class="[grid-column:2] text-xs cursor-help">{{ __('+:count more courses', ['count' => $hidden]) }}</div>
            @endif
        </div>
    </div>
    <x-ui::button :href="route('courses.group', $group)" variant="alt" class="justify-center mx-4">
        {{ __('View contents') }}
    </x-ui::button>
</x-ui::card>