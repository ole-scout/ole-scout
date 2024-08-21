@php
  $settings = app(\FossHaas\Consent\Settings\AppConsentSettings::class);
@endphp
<footer class="px-2 pb-24 space-y-8 md:p-8 lg:text-sm min-h-24 lg:min-h-16">
  <nav class="flex flex-wrap items-center justify-center space-x-1 md:space-x-2 *:p-1 *:block">
    @isset($settings->imprint_url)
    <x-link
      weight="normal"
      color="gray"
      href="{{ $settings->imprint() }}"
    >{{ __('Impressum') }}</x-link>
    @endisset
    <x-link
      weight="normal"
      color="gray"
      href="{{ $settings->privacyPolicy() }}"
    >{{ __('Datenschutz') }}</x-link>
    <x-link
      weight="normal"
      color="gray"
      href="{{ $settings->consent() }}"
    >{{ __('Datenschutz-Einstellungen') }}</x-link>
  </nav>
  <div class="flex justify-center">
    <x-link
      href="https://ole-scout.app"
      class="w-full opacity-50 hover:opacity-100 *:!no-underline *:leading-5 !gap-2 [&>svg]:mt-1 [&>svg]:size-7"
      weight="normal"
      color="white"
      icon="icon-ole-scout"
      lang="en"
    >
      powered by OLE Scout<br>
      made with <x-filament::icon
        icon="heroicon-m-heart"
        class="inline-block pb-px size-3 group-hover/link:text-red-500 group-focus/link:text-red-500"
        aria-label="love"
      /> in <abbr lang="de" class="no-underline" title="Ostwestfalen-Lippe">OWL</abbr>
    </x-link>
  </div>
</footer>