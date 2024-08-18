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

        <title>{{ config('app.name') }}</title>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @vite('resources/css/app.css')
        @stack('styles')
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

    <body class="min-h-screen antialiased font-normal bg-gray-50 text-gray-950 dark:bg-gray-950 dark:text-white">
        {{ $slot }}
        <x-consent::consent-modal />
        @filamentScripts
        @vite('resources/js/app.js')
        @stack('scripts')
    </body>
</html>
