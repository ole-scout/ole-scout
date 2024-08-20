@props([ 'wrapper' => null ])
<form
    id="consent"
    method="post"
    action="{{ route('consent.store') }}"
    x-data="consent"
    x-on:submit="submit($event)"
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
                async submit (evt) {
                    if (!evt) return document.getElementById('consent').requestSubmit();
                    evt.preventDefault();
                    try {
                        await fetch(evt.target.action, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(
                                Object.values(this.services).flatMap(
                                    services => Object.keys(services).filter(
                                        key => services[key]
                                    )
                                )
                            ),
                        });
                    } catch (error) {
                        console.error(error);
                        return;
                    }
                    window.location.reload();
                }
            }));
        });
    </script>
    @capture($content)
    <div class="text-sm leading-6 prose max-w-none dark:prose-invert [&>*:first-child]:mt-0 [&>*:last-child]:mb-0">
        @markdown(__("Diese Anwendung verwendet Cookies und ähnliche Technologien und verarbeitet personenbezogene Daten von Ihnen (z.B. IP-Adresse), um Inhalte und Funktionen zur Verfügung zu stellen oder Zugriffe zu analysieren.\n\nSie haben an dieser Stelle die Möglichkeit, Ihre Einwilligung in die Verarbeitung Ihrer personenbezogenen Daten zu bestimmten Zwecken zu erteilen. Sie können diese Einwilligung jederzeit widerrufen. Weitere Informationen zu Ihren Rechten und zur Verwendung Ihrer Daten finden Sie in der [Datenschutzerklärung](/privacy)."))
    </div>
    <x-consent::consent-form.category-list
        :$categories
        class="px-4"
    />
    <x-filament-partials::forms.tabs>
        <x-slot:tablist>
            @foreach($categories as $name => $label)
            <x-filament-partials::forms.tabs.tab
                :$name
                :badge="count($services[$name])"
                prefix="consent"
                alpineState="activeCategory"
                x-effect="updateBadge('{{ $name }}', selectedCount('{{ $name }}'))"
            >
                {{ $label }}
            </x-filament-partials::forms.tabs.tab>
            @endforeach
        </x-slot:tablist>
        @foreach($services as $category => $serviceList)
        <x-filament-partials::forms.tabs.panel
            :name="$category"
            prefix="consent"
            alpineState="activeCategory"
        >
            @foreach($serviceList as $service)
            <x-consent::consent-form.service-details
                :$service
                :$category
            />
            @endforeach
        </x-filament-partials::forms.tabs.panel>
        @endforeach
    </x-filament-partials::forms.tabs>
    @endcapture
    @if($wrapper)
    {{ $wrapper($content) }}
    @else
    {{ $content() }}
    <x-filament::button type="button" x-on:click="submit()">
        {{ __('Auswahl speichern') }}
    </x-filament::button>
    @endif
</form>