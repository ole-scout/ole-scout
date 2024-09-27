@props([
    'course',
])
@php
    $shades = \Filament\Support\Colors\Color::hex($course->color);
    foreach ($shades as $shade => $color) {
        $styles[] = "--c-{$shade}:{$color}";
    }
    $style = implode(';', $styles);
@endphp
<x-ui::card :layer="3" class="relative flex flex-col items-stretch pb-4 min-h-[28rem] isolate max-w-[18rem]" :$style>
    <div class="rounded-t-lg flex-shrink-0 w-full h-24 bg-opacity-50 saturate-[.8] bg-custom-500 dark:bg-custom-900">
    </div>
    <div class="relative flex justify-center -mt-20">
        <div class="p-4 overflow-hidden text-white border border-white rounded-full size-24 bg-custom-500 dark:border-gray-800">
            <x-ui::icon :icon="$course->icon" class="size-full" />
        </div>
    </div>
    <div class="absolute font-bold uppercase text-2xs top-4 left-4">
    {{ $course->slug }}
    </div>
    <div class="box-content flex items-center justify-center flex-shrink-0 py-1 mx-6 my-px overflow-hidden text-sm font-semibold leading-tight text-center min-h-12">{{ $course->title }}</div>
    <div class="flex flex-col flex-grow px-6 mt-4">
    </div>
    <x-ui::button href="route('courses.course', $course)" variant="alt" class="justify-center mx-4">
        <x-slot:slot>{{ __('View contents') }}</x-slot:slot>
    </x-ui::button>
</x-ui::card>