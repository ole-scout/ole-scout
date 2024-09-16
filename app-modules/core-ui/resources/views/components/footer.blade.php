@php
  $settings = app(\FossHaas\Consent\Settings\AppConsentSettings::class);
@endphp
<footer class="core::footer">
  <nav>
    @isset($settings->imprint_url)
    <x-ui::button href="{{ $settings->imprint() }}">{{ __('Impressum') }}</x-ui::button>
    @endisset
    <x-ui::button href="{{ $settings->privacyPolicy() }}">{{ __('Datenschutz') }}</x-ui::button>
    <x-ui::button href="{{ $settings->consent() }}">{{ __('Datenschutz-Einstellungen') }}</x-ui::button>
  </nav>
  <div class="core::footer-attribution">
    <x-ui::button size="sm"
      variant="neutral"
      href="https://ole-scout.app"
      icon="/icon-ole-scout"
      lang="en"
    >
      <x-slot:slot class="leading-5">
        powered by OLE Scout<br>
        made with <x-ui::icon size="sm" aria-label="love">heart</x-ui::icon>
        in <abbr lang="de" title="Ostwestfalen-Lippe">OWL</abbr>
      </x-slot:slot>
    </x-ui::button>
  </div>
</footer>