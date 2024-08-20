@php
  $settings = app(\FossHaas\Consent\Settings\AppConsentSettings::class);
@endphp
<footer class="px-2 pb-24 md:p-8 lg:text-sm min-h-24 lg:min-h-16">
  <nav class="flex flex-wrap items-center justify-center space-x-1 md:space-x-2">
    @isset($settings->imprint_url)
    <x-link class="block p-1 text-gray-700 md:px-2 dark:text-gray-200 hover:underline" href="{{ $settings->imprint() }}">{{ __('Impressum') }}</x-link>
    @endisset
    <x-link class="block p-1 text-gray-700 md:px-2 dark:text-gray-200 hover:underline" href="{{ $settings->privacyPolicy() }}">{{ __('Datenschutz') }}</x-link>
    <x-link class="block p-1 text-gray-700 md:px-2 dark:text-gray-200 hover:underline" href="{{ $settings->consent() }}">{{ __('Datenschutz-Einstellungen') }}</x-link>
  </nav>
  <div class="flex justify-center mt-16">
    <x-link href="https://ole-scout.app" class="flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white group">
      @svg('icon-ole-scout', 'w-7 h-7 mx-1 fill-current')
      <span class="ml-1 mr-3 text-xs" lang="en">
      powered by OLE Scout<br>
      made with <span class="group-hover:text-red-500 group-focus:text-red-500" aria-label="love">♥️</span>
      in <abbr lang="de" class="no-underline" title="Ostwestfalen-Lippe">OWL</abbr>
      </span>
    </x-link>
  </div>
</footer>