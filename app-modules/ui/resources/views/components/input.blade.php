@props(['size' => null])
@if($attributes->get('type') === 'file')
<x-ui::file-picker {{ $attributes->merge(['size' => $size]) }} />
@elseif($attributes->get('type') === 'textarea')
<textarea {{ $attributes->filter(
    fn (string $value, string $key) => $key !== 'value'
)->class(
    ['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']
) }}>{{ $attributes->get('value') }}</textarea>
@else
<input {{ $attributes->class(
    ['input', 'input-sm' => $size === 'sm', 'input-lg' => $size === 'lg']
) }}>
@endif