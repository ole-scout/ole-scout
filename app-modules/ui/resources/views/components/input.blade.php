@props([
    'size' => null,
    'action' => null,
    'actionTrailing' => null,
])
@php
    $actionAttributes = (
        isset($action->attributes)
        ? $action->attributes->get('attributes') ?: $action->attributes
        : $attributes->only([])
    )->class(['action']);
    if ($actionAttributes->has('component')) {
        $actionComponent = $actionAttributes->get('component');
        $actionAttributes = $actionAttributes->except('component')->merge(
            ['size' => $size]
        );
    }
    $actionTrailingAttributes = (
        isset($actionTrailing->attributes)
        ? $actionTrailing->attributes->get('attributes') ?: $actionTrailing->attributes
        : $attributes->only([])
    )->class(['action']);
    if ($actionTrailingAttributes->has('component')) {
        $actionTrailingComponent = $actionTrailingAttributes->get('component');
        $actionTrailingAttributes = $actionTrailingAttributes->except('component')->merge(
            ['size' => $size]
        );
    }
@endphp
@if($attributes->get('type') === 'file')
<x-ui::file-picker {{ $attributes->merge(['size' => $size]) }} />
@else
<span {{ $attributes->only(['class'])->class(
    ['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']
) }}>
@isset($actionComponent)
<x-dynamic-component :component="$actionComponent" :attributes="$actionAttributes">{{ $action }}</x-dynamic-component>
@else
@if($action)<span {{ $actionAttributes }}>{{ $action }}</span>@endif
@endisset
@if($attributes->get('type') === 'textarea')
<textarea {{ $attributes->except(['class', 'value'])->class(['input-area']) }}>{{
    $attributes->get('value')
}}</textarea>
@else
<input {{ $attributes->except(['class'])->class(['input-area']) }}>
@endif
@isset($actionTrailingComponent)
<x-dynamic-component :component="$actionTrailingComponent" :attributes="$actionTrailingAttributes">{{ $actionTrailing }}</x-dynamic-component>
@else
@if($actionTrailing)<span {{ $actionTrailingAttributes }}>{{ $actionTrailing }}</span>@endif
@endisset
</span>
@endif