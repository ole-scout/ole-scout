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
    //$tabs = Arr::mapWithKeys($tabs, fn($v,$k) => [$k => as_slot($v)]);
@endphp
<div class="tab-pane card" x-id="['tab-pane']">
    <div role="tablist">
        @foreach($tabs as $value => $tab)
        <x-ui::tab-pane.tab
            :$value
            :$values
            :isActive="$value === $initialValue"
            :$alpineState
        >{{ $tab }}</x-ui::tab-pane.tab>
        @endforeach
    </div>
    @foreach($panels as $i => $panel)
        <x-ui::tab-pane.panel
            :value="$values[$i]"
            :isActive="$value === $initialValue"
            :$alpineState
        >{{ $panel }}</x-ui::tab-pane.panel>
    @endforeach
</div>