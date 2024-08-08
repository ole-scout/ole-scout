@php
    use Illuminate\Support\Str;
    function markdown(string $text): string
    {
        return Str::of($text)->markdown([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }
@endphp
<form
    id="consent"
    method="post"
    x-data="consent"
    @submit="
        $event.preventDefault();
        console.log(JSON.stringify(services, null, 2), $event);
    "
>
    <script>
        "use strict";
        document.addEventListener('alpine:init', () => {
            Alpine.data('consent', () => ({
                services: @js($selected),
                activeCategory: 'essential',
                selectAll (cat) {
                    const services = cat ? [this.services[cat]] : Object.values(this.services);
                    for (const service of services) {
                        for (const key of Object.keys(service)) {
                            service[key] = true;
                        }
                    }
                },
                toggleAll (cat) {
                    const services = cat ? [this.services[cat]] : Object.values(this.services);
                    const selected = services.every(service => Object.values(service).every( v => v));
                    for (const service of services) {
                        for (const key of Object.keys(service)) {
                            service[key] = !selected;
                        }
                    }
                },
                toggle (cat, prv) {
                    console.log('toggle', cat, prv, this.services[cat][prv])
                    this.services[cat][prv] = !this.services[cat][prv];
                },
                isSelected (cat, prv) {
                    if (!cat) return Object.keys(this.services).every(cat => this.isSelected(cat));
                    if (prv) return this.services[cat][prv];
                    return Object.keys(this.services[cat]).every(prv => this.isSelected(cat, prv));
                },
                isSomeSelected (cat) {
                    if (!cat) return Object.keys(this.services).some(cat => this.isSelected(cat));
                    return Object.keys(this.services[cat]).some(prv => this.services[cat][prv]);
                },
                selectedCount (cat) {
                    const count = Object.values(this.services[cat]).filter(v => v).length;
                    return count;
                },
                updateBadge (cat, count) {
                    const badge = document.getElementById('consent-' + cat).querySelector('.fi-badge');
                    let leafNode = badge;
                    while (leafNode.firstElementChild) {
                        leafNode = leafNode.firstElementChild;
                    }
                    leafNode.textContent = count;
                    if (count) badge.classList.remove('hidden');
                    else badge.classList.add('hidden');
                },
                selectAllAndSubmit () {
                    this.selectAll();
                    this.submit();
                },
                submit () {
                    document.getElementById('consent').requestSubmit();
                }
            }));
        });
    </script>
    <x-consent::modal>
        <x-slot name="heading">
            {{ __('Datenschutz-Einstellungen') }}
        </x-slot>
        <x-slot name="footerActions">
            <x-filament::button class="flex-grow" @click="selectAllAndSubmit()">{{ __('Alle akzeptieren') }}</x-filament::button>
            <x-filament::button class="flex-grow" @click="submit()">{{ __('Auswahl speichern') }}</x-filament::button>
        </x-slot>
        <div class="text-sm leading-6">
            {!! markdown(__("Diese Anwendung verwendet Cookies und ähnliche Technologien und verarbeitet personenbezogene Daten von Ihnen (z.B. IP-Adresse), um Inhalte und Funktionen zur Verfügung zu stellen oder Zugriffe zu analysieren.\n\nSie haben an dieser Stelle die Möglichkeit, Ihre Einwilligung in die Verarbeitung Ihrer personenbezogenen Daten zu bestimmten Zwecken zu erteilen. Sie können diese Einwilligung jederzeit widerrufen. Weitere Informationen zu Ihren Rechten und zur Verwendung Ihrer Daten finden Sie in der [Datenschutzerklärung](/privacy).")) !!}
        </div>
        <x-filament-partials::forms.component-container class="px-4 sm:grid-cols-2 md:grid-cols-5">
            <x-filament-partials::forms.actions>
                <x-filament-partials::actions.link
                    button
                    @click="selectAll()"
                    x-show="!isSelected()"
                >
                    {{ __('Alle auswählen') }}
                </x-filament-partials::actions.link>
            </x-filament-partials::forms.actions>
            @foreach ($categories as $name => $label)
            <x-filament-forms::field-wrapper>
                <x-slot name="label">{{ $label }}</x-slot>
                <x-slot name="labelPrefix">
                    <x-filament::input.checkbox
                        :name="$name"
                        :disabled="$name === 'essential'"
                        x-bind:checked="isSelected($el.name)"
                        @change="toggleAll($el.name)"
                    />
                </x-slot>
            </x-filament-forms::field-wrapper>
            @endforeach
        </x-filament-partials::forms.component-container>
        <x-filament-partials::forms.tabs>
            <x-slot name="tablist">
                @foreach ($categories as $name => $label)
                <x-filament-partials::forms.tabs.tab
                    :name="$name"
                    :badge="count($services[$name])"
                    prefix="consent"
                    alpineState="activeCategory"
                    x-effect="updateBadge('{{ $name }}', selectedCount('{{ $name }}'))"
                >
                    {{ $label }}
                </x-filament-partials::forms.tabs.tab>
                @endforeach
            </x-slot>
            @foreach ($services as $cat => $serviceList)
            <x-filament-partials::forms.tabs.panel
                :name="$cat"
                prefix="consent"
                alpineState="activeCategory"
            >
                @foreach ($serviceList as $service)
                <x-filament::fieldset :label="$service['name']" label-hidden>
                    <x-filament-partials::forms.component-container class="sm:grid-cols-2">
                        <div class="space-y-6">
                            <x-filament-forms::field-wrapper>
                                <x-slot name="labelPrefix">
                                    <x-filament-partials::forms.toggle
                                        alpineActive="isSelected('{{ $cat }}', '{{ $service['id'] }}')"
                                        :initialChecked="$cat === 'essential'"
                                        @click="toggle('{{ $cat }}', '{{ $service['id'] }}')"
                                    />
                                </x-slot>
                                <x-slot name="label">
                                    {{ $service['name'] }}
                                </x-slot>
                                <x-slot name="helperText">
                                    {{ $service['description'] }}
                                </x-slot>
                            </x-filament-forms::field-wrapper>
                            @if (array_key_exists('provider', $service) && !empty($service['provider']))
                            <x-consent::provider-details :provider="$service['provider']" />
                            @endif
                        </div>
                        @if (array_key_exists('cookies', $service) && !empty($service['cookies']))
                        <div>
                            <x-consent::cookie-list :cookies="$service['cookies']" />
                        </div>
                        @endif
                    </x-filament-partials::forms.component-container>
                </x-filament::fieldset>
                @endforeach
            </x-filament-partials::forms.tabs.panel>
            @endforeach
        </x-filament-partials::forms.tabs>
    </x-consent::modal>
</form>