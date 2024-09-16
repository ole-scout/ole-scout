@php
    $toggleAttributeTuples = [
        [['inline' => 'trailing'], ['required' => true]],
        [['icon' => 'warning', 'inline' => 'trailing'], []],
        [['iconTrailing' => 'warning', 'inline' => 'trailing'], ['checked' => true]],
        [['inline' => 'trailing'], ['required' => true, 'disabled' => true]],
        [['icon' => 'warning', 'inline' => true], ['disabled' => true]],
        [['iconTrailing' => 'warning', 'inline' => true], ['checked' => true, 'disabled' => true]],
    ];
@endphp
<div class="my-8 space-y-8">
    @foreach([0,1,2] as $i)
    @foreach(['sm', 'md', 'lg'] as $size)
    <x-ui::card :layer="$i + 1">
        <div class="grid {{ match($size) {
            'sm' => 'max-w-xl',
            'md' => 'max-w-2xl',
            'lg' => 'max-w-4xl',
        } }} grid-cols-6 gap-4 mx-auto place-items-center">
            <x-ui::file-picker :$size variant="alt" class="col-span-full">Choose file …</x-ui::file-picker>

            <x-ui::input :$size type="text" placeholder="Placeholder" class="col-span-full" />
            <x-ui::input :$size type="text" value="Invalid" pattern="\d+" class="col-span-full" />
            <x-ui::input :$size type="text" value="Text field" class="col-span-full" />
            <x-ui::input :$size type="text" value="Text field" disabled class="col-span-full" />
            <x-ui::input :$size type="textarea" value="Text area" class="col-span-full" />
            <x-ui::input :$size type="text" placeholder="Search" class="col-span-full"><x-slot:actionTrailing component="ui::button" variant="link">Search</x-slot:actionTrailing></x-ui::input>
            <x-ui::input :$size type="text" placeholder="Search" class="col-span-full"><x-slot:actionTrailing component="ui::button" variant="alt" icon="search" hiddenLabel>Search</x-slot:actionTrailing></x-ui::input>
            <x-ui::input :$size type="text" placeholder="Search" class="col-span-full"><x-slot:action component="ui::button" variant="ghost" icon="search" hiddenLabel>Search</x-slot:action></x-ui::input>
            <x-ui::input :$size type="text" placeholder="Search" class="col-span-full"><x-slot:actionTrailing component="ui::button" icon="search" hiddenLabel>Search</x-slot:actionTrailing></x-ui::input>
            <x-ui::input :$size type="text" placeholder="Search" class="col-span-full"><x-slot:actionTrailing component="ui::button" intent="primary" icon="search" hiddenLabel>Search</x-slot:actionTrailing></x-ui::input>

            <div class="flex w-full gap-2 col-span-full">
                <x-ui::input :$size type="text" placeholder="Placeholder" class="col-span-4" />
                <x-ui::button :$size intent="primary" icon="save">Save</x-ui::input>
            </div>

            @foreach($toggleAttributeTuples as $j => [$fieldAttributes, $inputAttributes])
            <x-ui::field :$size :attributes="as_attributes($fieldAttributes)->merge([
                'name' => join('-', [$size, 'checkbox', $i, $j])
            ])">
                <x-slot:label>Click</x-slot:label>
                <x-slot:input :attributes="as_attributes($inputAttributes)->merge([
                    'component' => 'ui::checkbox',
                ])"></x-slot:input>
            </x-ui::field>
            @endforeach

            @foreach($toggleAttributeTuples as $j => [$fieldAttributes, $inputAttributes])
            <x-ui::field :$size :attributes="as_attributes($fieldAttributes)->merge([
                'name' => join('-', [$size, 'radio', $i, floor($j / 2)])
            ])">
                <x-slot:label>Click</x-slot:label>
                <x-slot:input :attributes="as_attributes($inputAttributes)->merge([
                    'component' => 'ui::radio',
                    'value' => strval($j % 2),
                ])"></x-slot:input>
            </x-ui::field>
            @endforeach

            @foreach($toggleAttributeTuples as $j => [$fieldAttributes, $inputAttributes])
            <x-ui::field :$size :attributes="as_attributes($fieldAttributes)->merge([
                'name' => join('-', [$size, 'switch', $i, $j])
            ])">
                <x-slot:label>Click</x-slot:label>
                <x-slot:input :attributes="as_attributes($inputAttributes)->merge([
                    'component' => 'ui::switch',
                ])"></x-slot:input>
            </x-ui::field>
            @endforeach
        </div>
    </x-ui::card>
    @endforeach
    @endforeach
</div>