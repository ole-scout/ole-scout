@use(FossHaas\Consent\Settings\AppConsentSettings)
@props([
    'id' => 'consent-form',
])
@php
    $settings = app(AppConsentSettings::class);
    $initial = json_encode($selected);
    $slot = as_slot($slot);
    $attributes = as_attributes($attributes)->merge([
        'id' => $id,
        'method' => 'post',
        'action' => route('consent.store'),
    ]);
@endphp
<form {{ $attributes }} x-data="consent_form(@js($selected))" x-ui-busy>
    <div class="text-sm leading-6 prose max-w-none dark:prose-invert [&>*:first-child]:mt-0 [&>*:last-child]:mb-0">
        {!! markdown(__("Diese Anwendung verwendet Cookies und ähnliche Technologien und verarbeitet personenbezogene Daten von Ihnen (z.B. IP-Adresse), um Inhalte und Funktionen zur Verfügung zu stellen oder Zugriffe zu analysieren.\n\nSie haben an dieser Stelle die Möglichkeit, Ihre Einwilligung in die Verarbeitung Ihrer personenbezogenen Daten zu bestimmten Zwecken zu erteilen. Sie können diese Einwilligung jederzeit in den [Datenschutz-Einstellungen](:consent_url) widerrufen. Weitere Informationen zu Ihren Rechten und zur Verwendung Ihrer Daten finden Sie in der [Datenschutzerklärung](:privacy_url).", ['consent_url' => $settings->consent_url, 'privacy_url' => $settings->privacy_url])) !!}
    </div>
    <x-consent::consent-form.category-list
        :$categories
        class="px-4"
    />
    <x-ui::tab-pane>
        @foreach($categories as $category => $label)
        <x-ui::tab-pane.tab
            :$label
            :value="$category"
            :badgeExpression="'countSelected(\'' . $category . '\')'"
            class="space-y-4"
        >
            @foreach($services[$category] as $service)
            <x-consent::consent-form.service-details :$service :$category/>
            @endforeach
        </x-ui::tab-pane.tab>
        @endforeach
    </x-ui::tab-pane>
    {{ render_slot($slot) }}
</form>