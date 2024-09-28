@php
  $settings = app(\FossHaas\Consent\Settings\AppConsentSettings::class);
@endphp
<footer class="core__footer">
  <nav>
    @isset($settings->imprint_url)
    <x-ui::button href="{{ $settings->imprint() }}">{{ __('Imprint') }}</x-ui::button>
    @endisset
    <x-ui::button href="{{ $settings->privacyPolicy() }}">{{ __('Privacy policy') }}</x-ui::button>
    <x-ui::button href="{{ $settings->consent() }}">{{ __('Privacy settings') }}</x-ui::button>
  </nav>
  <div class="core__footer-attribution">
    <x-ui::button size="sm"
      variant="neutral"
      href="https://ole-scout.app"
      lang="en"
    >
      <x-slot:icon icon="icon-ole-scout"></x-slot:icon>
      <x-slot:slot class="leading-5">
        powered by OLE Scout<br>
        made with <x-ui::icon size="sm" aria-label="love" icon=":heart"></x-ui::icon>
        in <abbr lang="de" title="Ostwestfalen-Lippe">OWL</abbr>
      </x-slot:slot>
    </x-ui::button>
  </div>
</footer>