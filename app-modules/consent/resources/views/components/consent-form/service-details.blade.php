@props([ 'service', 'category' ])
<x-filament::fieldset :label="$service->name" label-hidden>
    <x-filament-partials::forms.component-container class="sm:grid-cols-2">
        <div class="space-y-6">
            <x-filament-forms::field-wrapper>
                <x-slot:labelPrefix>
                    <x-filament-partials::forms.toggle
                        alpineActive="isSelected('{{ $category }}', '{{ $service->id }}')"
                        :initialChecked="$category === 'essential'"
                        :disabled="$category === 'essential'"
                        x-on:click="toggle('{{ $category }}', '{{ $service->id }}')"
                    />
                </x-slot:labelPrefix>
                <x-slot:label>{{ $service->name }}</x-slot:label>
                <x-slot:helperText>@markdown($service->description)</x-slot:helperText>
            </x-filament-forms::field-wrapper>
            <x-consent::consent-form.provider-details :provider="$service->serviceProvider" />
        </div>
        @if($service->serviceCookies->count())
        <div>
            <x-consent::consent-form.cookie-list :cookies="$service->serviceCookies" />
        </div>
        @endif
    </x-filament-partials::forms.component-container>
</x-filament::fieldset>