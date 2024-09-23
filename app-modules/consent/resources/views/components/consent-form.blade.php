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
        {!! markdown(__("This app uses a number of services which use cookies and similar technologies to provide its content and functionalities to you or to analyze user behavior. Some of these services need to store or process your personal data in order to function.\n\nYou have the option to consent to the use of non-essential services for specific purposes or proceeding without them. You can always revoke or review your consent by viewing the [privacy settings](:consent_url) at any point. You can find more information about your rights and the use of your personal data by this app in the [privacy policy](:privacy_url).", ['consent_url' => $settings->consent_url, 'privacy_url' => $settings->privacy_url])) !!}
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