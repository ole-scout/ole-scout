@props([
    'size' => null,
    'action' => null,
    'actionTrailing' => null,
])
@if($attributes->get('type') === 'file')
<x-ui::file-picker {{ $attributes->merge(['size' => $size]) }} />
@else
<span {{ $attributes->only(['class'])->class(
    ['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']
) }}>
@if($action)<span {{ $action->attributes->merge(
    ['class' => 'action']
) }}>{{ $action }}</span>@endif
@if($attributes->get('type') === 'textarea')
<textarea {{ $attributes->except(['class', 'value'])->class(['input-area']) }}>{{
    $attributes->get('value')
}}</textarea>
@else
<input {{ $attributes->except(['class'])->class(['input-area']) }}>
@endif
@if($actionTrailing)<span {{ $actionTrailing->attributes->merge(
    ['class' => 'action']
) }}>{{ $actionTrailing }}</span>@endif
</span>
@endif