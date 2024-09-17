@props([
    'icon' => null,
    'title' => null,
    'size' => 'lg',
])
@use('Filament\Support\Colors\Color')
@php
    $branding = app(\App\Settings\BrandingSettings::class);
    $icon = as_slot($icon);
    $title = as_slot($title);
    $size = (string) $size;
@endphp
<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
>
    <head>
        <meta charset="utf-8" />
        <meta name="application-name" content="{{ $branding->name }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ $title ? "{$title} · {$branding->name}" : $branding->name }}</title>

        @vite('resources/css/app.css')
        @stack('styles')
        @livewireStyles
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
            'use strict';
            const theme = localStorage.getItem('theme') ?? 'system';
            if (theme === 'dark' || (
                theme === 'system' &&
                window.matchMedia('(prefers-color-scheme: dark)').matches
            )) {
                document.documentElement.classList.add('dark');
            }
        </script>
    </head>

    <body class="{{ match($size) {
        'sm' => 'page-sm',
        'md' => 'page-md',
        'lg' => 'page-lg',
        default => null,
    } }}">
        <header>
            @if($branding->logo)
            <img src="{{ $branding->logo }}" alt="{{ $branding->name }}" />
            @else
            <span>{{ $branding->name }}</span>
            @endif
        </header>
        <main>
            <x-core-ui::theme-picker
                x-data subtle vertical
                class="absolute top-0 lg:top-4 sm:fixed right-4"
            />
            <x-ui::card>
                @if($title->isNotEmpty())
                <x-slot:title :attributes="$title->attributes">{{ $title }}</x-slot:title>
                @endif
                @if($icon->attributes->isNotEmpty())
                <x-slot:icon :attributes="$icon->attributes">{{ $icon }}</x-slot:icon>
                @endif
                {{ $slot }}
            </x-ui::card>
        </main>
        <x-core-ui::footer />
        @unlessconsentgiven
        <x-consent::consent-modal />
        @endconsentgiven
        @vite('resources/js/app.js')
        @stack('scripts')
        @livewireScriptConfig
    </body>
</html>
