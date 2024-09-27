@props([
    'icon' => null,
    'title' => null,
    'crumbs' => null,
    'size' => null,
])
@use('Filament\Support\Colors\Color')
@php
    $branding = app(\App\Settings\BrandingSettings::class);
    $icon = as_slot($icon);
    $title = as_slot($title);
    $crumbs = as_slot($crumbs)->attributes->get('crumbs');
    $size = (string) $size;
    if ($crumbs === null) {
        $crumbs = Request::is("/") ? false : [];
    }
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
            <img class="logo" src="{{ $branding->logo }}" alt="{{ $branding->name }}" />
            @else
            <span class="logo">{{ $branding->name }}</span>
            @endif
            @if($crumbs !== false)
            <div class="flex items-center gap-0.5 py-4 breadcrumbs text-xs text-gray-900 dark:text-gray-300 [&>*]:opacity-90 [&>a:hover]:opacity-100">
                <a href="/" wire:navigate><x-ui::icon class="size-[1.5em]" icon=":home" class="text-gray-600 dark:text-gray-500" /></a>
                @foreach($crumbs as $href => $link)
                <x-ui::icon icon=":chevron-right:o" class="size-[1em] text-gray-600 dark:text-gray-500" />
                {{ render_slot($link, ['class' => 'hover:underline', 'href' => $href, 'wire:navigate'], fallbackTag: 'a') }}
                @endforeach
                <x-ui::icon icon=":chevron-right:o" class="size-[1em] text-gray-600 dark:text-gray-500" />
                <span class="cursor-default">{{ $title }}</span>
            </div>
            @endif
        </header>
        <main>
            <x-core-ui::theme-picker
                subtle vertical
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
