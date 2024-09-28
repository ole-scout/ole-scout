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
<div class="core__card_course-list" x-id="['progress']">
    <div class="intro">
        {{ trans_choice(
            'This category contains one course:|This category contains :count courses:',
            $courses->count()
        ) }}
    </div>
    @foreach($courses->take($numVisible) as $course)
    <div x-bind:id="$id('progress', '{{ $course->slug }}')" class="slug" title="{{ $course->title }}">{{ $course->slug }}</div>
    <x-ui::progress-bar :progress="$course->states->first()?->percent_complete ?? 0" size="sm">
        <x-slot:slot :aria-labelledby="'$id(\'progress\', ' . $course->slug . '\')'"></x-slot:slot>
    </x-ui::progress-bar>
    @endforeach
    @if($numHidden > 0)
    <div class="more" title="{{
        $courses
        ->take(-$numHidden)
        ->map(fn($course) => sprintf(
            '%s: %s (%d %%)',
            $course->slug,
            $course->title,
            $course->states->first()?->percent_complete ?? 0,
        ))
        ->join("\n")
    }}">{{ __('+:count more courses', ['count' => $numHidden]) }}</div>
    @endif
</div>