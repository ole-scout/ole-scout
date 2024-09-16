@props([
    'span',
    'sm:span',
    'md:span',
    'lg:span',
    'xl:span',
    'label',
])
@php
    $label = as_slot($label);
    $slot = as_slot($slot);
    $parseColSpan = function (int|string $colSpan): string {
        if ($colSpan === 'full') return '1 / -1';
        if (!is_numeric($colSpan)) return $colSpan;
        return "span {$colSpan} / span {$colSpan}";
    };
    $breakpoints = [ 
        'sm' => 'sm:col-[--col-span-sm]',
        'md' => 'md:col-[--col-span-md]',
        'lg' => 'lg:col-[--col-span-lg]',
        'xl' => 'xl:col-[--col-span-xl]',
    ];
    $style = [];
    $class = [];
    if (isset($span)) {
        $style[] = "--col-span: {$parseColSpan($span)}";
        $class[] = 'col-[--col-span]';
    }
    foreach ($breakpoints as $breakpoint => $breakpointClass) {
        $colSpanVariable = "{$breakpoint}:span";
        if (!isset($$colSpanVariable)) continue;
        $colSpan = $$colSpanVariable;
        
        $style[] = "--col-span-{$breakpoint}: {$parseColSpan($colSpan)}";
        $class[] = $breakpointClass;
    }
@endphp
<div {{ $attributes->style($style)->class($class) }}>
{{ render_slot($label, fallbackTag: 'dt') }}
{{ render_slot($slot, fallbackTag: 'dd') }}
</div>