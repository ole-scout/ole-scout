@use('Filament\Support\Colors\Color')
@php
    $branding = app(\App\Settings\BrandingSettings::class);
@endphp
<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
>
    <head>
        <meta charset="utf-8" />
        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ isset($title) ? $title . ' · ' : '' }}{{ config('app.name') }}</title>

        @vite('resources/css/app.css')
        @stack('styles')
        <style>
            [x-cloak] {
                display: none !important;
            }
            :root {
                @foreach(Color::hex($branding->brandColor) as $shade => $value)
                --brand-{{ $shade }}: {{ $value }};
                @endforeach
                @foreach(Color::hex($branding->primaryColor) as $shade => $value)
                --primary-{{ $shade }}: {{ $value }};
                @endforeach
            }
        </style>
        <script>
            const theme = localStorage.getItem('theme') ?? 'system';

            if (
                theme === 'dark' ||
                (theme === 'system' &&
                    window.matchMedia('(prefers-color-scheme: dark)')
                        .matches)
            ) {
                document.documentElement.classList.add('dark');
            }
        </script>
    </head>

    <body>
        <main>{{ $slot }}</main>
        <x-core-ui::footer class="flex-grow-0 flex-shrink-0" />
        @unlessconsentgiven
        <x-consent::consent-modal />
        @endconsentgiven
        @vite('resources/js/app.js')
        @stack('scripts')
    </body>
</html>
