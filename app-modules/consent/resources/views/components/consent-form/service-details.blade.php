@props([
    'service',
    'category',
])
@php
    $switchAttributes = as_attributes([
        'component' => 'ui::switch',
        'checked' => $category === 'essential',
        'disabled' => $category === 'essential',
        'x-bind:checked' => "isSelected('{$category}', '{$service->id}')",
        'x-bind:disabled' => $category === 'essential' ? null : 'isSubmitting',
        'x-on:click' => "toggle('{$category}', '{$service->id}')",
    ]);
@endphp
<x-ui::fieldset>
    <div class="pb-4 md:inline-block md:pt-2">
        <x-ui::field :name="$service->id" :label="$service->name" size="lg" inline="trailing">
            <x-slot:input :attributes="$switchAttributes"></x-slot:input>
        </x-ui::field>
    </div>
    <div class="pb-4 sm:float-right sm:w-2/3 sm:ml-2 sm:pl-2 md:w-1/2">
        <x-consent::consent-form.provider-details :provider="$service->serviceProvider" />
    </div>
    <div class="text-sm leading-6 prose max-w-none dark:prose-invert empty:hidden hyphens-auto">
        {!! markdown($service->description) !!}
    </div>
    @if($service->serviceCookies->count())
    <div class="clear-both pt-4">
        <x-consent::consent-form.cookie-list :cookies="$service->serviceCookies" class="w-full" />
    </div>
    @endif
</x-ui::fieldset>