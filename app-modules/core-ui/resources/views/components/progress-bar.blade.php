@props([
    'progress' => null,
    'size' => null,
])
@php
    $attributes = as_attributes($attributes);
    $slot = as_slot($slot);
    $total = $progress ? $progress['required_total'] + $progress['optional_total'] : 0;
    if ($total > 0) {
        $percent_total = (int) round((
            ($progress['required_completed'] + $progress['optional_completed']) /
            ($progress['required_total'] + $progress['optional_total'])
        ) * 100);
        $required_completed = (int) round((
            $progress['required_completed'] / $total
        ) * 100);
        $required_missing = (int) round((
            ($progress['required_total'] - $progress['required_completed']) /
            $total
        ) * 100);
        $optional_completed = (int) round((
            $progress['optional_completed'] / $total
        ) * 100);
        $optional_missing = (int) round((
            ($progress['optional_total'] - $progress['optional_completed']) /
            $total
        ) * 100);
    } else {
        $percent_total = 0;
        $required_completed = 0;
        $required_missing = 0;
        $optional_completed = 0;
        $optional_missing = 0;
    }
    if ($progress && $progress['required_completed'] > 0) {
        if ($progress['optional_completed'] > 0) {
            $message = __(':required % of required activities, :optional % of optional activities completed', [
                'required' => (int) round(($progress['required_completed'] / $progress['required_total']) * 100),
                'optional' => (int) round(($progress['optional_completed'] / $progress['optional_total']) * 100),
            ]);
        } else {
            $message = __(':required % of activities completed', [
                'required' => (int) round(($progress['required_completed'] / $progress['required_total']) * 100),
            ]);
        }
    } elseif ($progress && $progress['optional_completed'] > 0) {
        $message = __(':optional % of activities completed', [
            'optional' => (int) round(($progress['optional_completed'] / $progress['optional_total']) * 100),
        ]);
    } else {
        $message = __('No activities completed');
    }
@endphp
@capture($transform, $contents)
<div class="bar" aria-hidden="true" title="{{ $message }}">
    @if($optional_completed > 0)
    <div class="fill optional completed" style="width: {{ $optional_completed }}%"></div>
    @endif
    @if($required_completed > 0)
    <div class="fill required completed" style="width: {{ $required_completed }}%"></div>
    @endif
    @if($required_missing > 0)
    <div class="fill required missing" style="width: {{ $required_missing }}%"></div>
    @endif
    @if($optional_missing > 0)
    <div class="fill optional missing" style="width: {{ $optional_missing }}%"></div>
    @endif
</div>
<progress {{ $slot->attributes->merge([
    'value' => $percent_total,
    'max' => '100'
])->class('sr-only') }}>{{ $message }}</progress>
@endcapture
{{ render_slot(
    $slot->toHtml(),
    $attributes->class([
        'progress',
        'core__progress',
        'full' => $percent_total === 100,
        match($size) {
            'sm' => 'progress-sm',
            default => null,
            'lg' => 'progress-lg',
        }
    ]),
    transform: $transform,
    fallbackTag: 'div'
) }}