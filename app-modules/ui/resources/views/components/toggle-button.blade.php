@props([
    'checked' => false,
    'onIcon' => null,
    'offIcon' => null,
    'onIconTrailing' => null,
    'offIconTrailing' => null,
    'alpineState' => 'state',
])
@php
    $icon = ($onIcon && $offIcon) ? ['on' => $onIcon, 'off' => $offIcon] : null;
    $iconTrailing = ($onIconTrailing && $offIconTrailing) ? ['on' => $onIconTrailing, 'off' => $offIconTrailing] : null;
    $onClick = $attributes->get('x-on:click');
    $attributes = $attributes->merge([
        'role' => 'switch',
        'aria-checked' => $checked ? 'true' : 'false',
    ]);
    $iconAttributes = [
        'on' => ['hidden' => !$checked ? 'hidden' : null, 'data-when-checked' => 'show'],
        'off' => ['hidden' => $checked ? 'hidden' : null, 'data-when-checked' => 'hide'],
    ]
@endphp
@once
@push('scripts')
<script type="module">
document.addEventListener('alpine:init', () => {
    Alpine.directive('ui-toggle-button', function (el, _, { cleanup, evaluate }) {
        const handler = (event) => {
            const $el = event.currentTarget;
            const checked = $el.ariaChecked !== 'true';
            $el.ariaChecked = checked;
            let hidden = $el.querySelectorAll('[data-when-checked="show"]');
            let shown = $el.querySelectorAll('[data-when-checked="hide"]');
            if (!checked) [hidden, shown] = [shown, hidden];
            for (const toShow of hidden) toShow.removeAttribute('hidden');
            for (const toHide of shown) toHide.setAttribute('hidden', 'hidden');
            evaluate(`$dispatch('ui-toggle', ${checked});`);
        };
        el.addEventListener('click', handler);
        cleanup(() => el.removeEventListener('click', handler));
    });
});
</script>
@endpush
@endonce
<x-ui::button x-ui-toggle-button
    :$icon :$iconTrailing :$iconAttributes
    :$attributes
>{{ $slot }}</x-ui::button>