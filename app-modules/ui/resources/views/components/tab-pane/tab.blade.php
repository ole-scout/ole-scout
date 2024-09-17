@props([
    'label',
    'value',
    'badgeExpression' => null,
])
{{ render_slot(
    as_slot($slot),
    $attributes->merge([
        "x-ui-tab-pane:${value}" => json_encode(['label' => $label, 'badge' => $badgeExpression]),
    ]),
    fallbackTag: 'div',
) }}