@use(Illuminate\Support\Arr)
@props([
    'tabs',
    'panels',
    'value' => null,
    'alpineState' => 'state',
])
@php
    $values = array_keys($tabs);
    $initialValue = $value ?? $values[0];
@endphp
<div class="tab-pane" x-id="['tab-pane']">
    <div role="tablist">
        @foreach($tabs as $value => $tab)
        {{ render_slot($tab, [
            'component' => 'ui::tab-pane.tab',
            'value' => $value,
            'values' => $values,
            'isActive' => $value === $initialValue,
            'alpineState' => $alpineState,
        ]) }}
        @endforeach
    </div>
    @foreach($panels as $value => $panel)
    {{ render_slot($panel, [
        'component' => 'ui::tab-pane.panel',
        'value' => $value,
        'isActive' => $value === $initialValue,
        'alpineState' => $alpineState,
    ]) }}
    @endforeach
</div>