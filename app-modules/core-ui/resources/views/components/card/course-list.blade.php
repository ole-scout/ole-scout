@props([
    'courses'
])
@php
    $numVisible = 7;
    $numHidden = $courses->count() - $numVisible;
    if ($numHidden === 1) {
        $numVisible += $numHidden;
        $numHidden = 0;
    }
@endphp
@capture($transform, $contents)
    <div class="intro">
        {{ trans_choice(
            'This category contains one course:|This category contains :count courses:',
            $courses->count()
        ) }}
    </div>
    @foreach($courses->take($numVisible) as $course)
    <div x-bind:id="$id('progress', '{{ $course->slug }}')" class="slug" title="{{ $course->title }}">{{ $course->slug }}</div>
    <x-core-ui::progress-bar :progress="$course->states->first()?->progress" size="sm">
        <x-slot:slot :aria-labelledby="'$id(\'progress\', ' . $course->slug . '\')'"></x-slot>
    </x-core-ui::progress-bar>
    @endforeach
    @if($numHidden > 0)
    <div class="more" title="{{
        $courses
        ->take(-$numHidden)
        ->map(fn($course) => sprintf(
            '%s: %s',
            $course->slug,
            $course->title,
        ) . (
            $course->states->first()?->progress['required_total'] ? floor((
                $course->states->first()->progress['required_completed'] /
                $course->states->first()->progress['required_total']
            ) * 100) . ' %' : ''
        ))
        ->join("\n")
    }}">{{ __('+:count more courses', ['count' => $numHidden]) }}</div>
    @if($contents)
    {{ render_slot($contents, $slot->attributes) }}
    @endif
    @endif
@endcapture
{{ render_slot(
    $slot->toHtml(),
    $attributes->merge(['x-id' => '[\'progress\']'])->class('core__card_course-list'),
    transform: $transform
) }}