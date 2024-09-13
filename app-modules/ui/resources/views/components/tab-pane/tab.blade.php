@props([
    'value',
    'values',
    'badge' => null,
    'isActive' => false,
    'alpineState' => 'state',
])
@php
    $numValues = count($values);
    if (!$numValues) throw new InvalidArgumentException('"values" must not be empty');
    $i = array_search($value, $values);
    if ($i === false) throw new InvalidArgumentException('"value" must occur in "values"');
    $firstValue = $values[0];
    $lastValue = $values[$numValues - 1];
    $nextValue = $value === $lastValue ? $firstValue : $values[$i + 1];
    $prevValue = $value === $firstValue ? $lastValue : $values[$i - 1];
    $badge = as_slot($badge, ['class' => 'badge']);
    $attributes = as_attributes($attributes, [
        'as' => 'div',
        'role' => 'tab',
        'x-bind:id' => "\$id('tab-pane', 'tab_{$value}')",
        'x-bind:aria-controls' => "\$id('tab-pane', 'tabpanel_{$value}')",
        'aria-selected' => $isActive ? 'true' : 'false',
        'tabindex' => $isActive ? '0' : '-1',
        'x-bind:aria-selected' => "{$alpineState} === '{$value}'",
        'x-bind:tabindex' => "{$alpineState} === '{$value}' ? 0 : -1",
        'x-on:click' => "${alpineState} = '{$value}'",
        'x-on:keyup.left' => "${alpineState} = '{$prevValue}';\$focus.focus(document.querySelector('#' + \$id('tab-pane', 'tab_{$prevValue}')))",
        'x-on:keyup.right' => "${alpineState} = '{$nextValue}';\$focus.focus(document.querySelector('#' + \$id('tab-pane', 'tab_{$nextValue}')))",
        'x-on:keyup.home' => "${alpineState} = '{$firstValue}';\$focus.focus(document.querySelector('#' + \$id('tab-pane', 'tab_{$firstValue}')))",
        'x-on:keyup.end' => "${alpineState} = '{$lastValue}';\$focus.focus(document.querySelector('#' + \$id('tab-pane', 'tab_{$lastValue}')))",
    ]);
@endphp
@capture($wrapper, $slot)
<span>{{ $slot }}</span>
{{ render_slot($badge, allowEmpty: true) }}
@endcapture
{{ render_slot($wrapper($slot), $attributes) }}