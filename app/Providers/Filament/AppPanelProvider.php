<?php

namespace App\Providers\Filament;

use App\Settings\BrandingSettings;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
    public function register(): void
    {
        parent::register();
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            \Filament\View\PanelsRenderHook::SCRIPTS_AFTER,
            fn(): string => \Illuminate\Support\Facades\Blade::render(
                "@unlessconsentgiven\n<x-consent::consent-modal />\n@endconsentgiven"
            ),
        );
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            \Filament\View\PanelsRenderHook::SCRIPTS_AFTER,
            fn(): string => \Illuminate\Support\Facades\Blade::render(
                "@vite('resources/js/app.js')"
            ),
        );
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            \Filament\View\PanelsRenderHook::STYLES_AFTER,
            fn(): string => \Illuminate\Support\Facades\Blade::render(
                "@vite('resources/css/app.css')"
            ),
        );
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            \Filament\View\PanelsRenderHook::FOOTER,
            fn(): string => \Illuminate\Support\Facades\Blade::render(
                "<x-core.footer />"
            ),
        );
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('app')
            ->bootUsing(function (Panel $panel) {
                $settings = app(BrandingSettings::class);
                \Filament\Support\Facades\FilamentColor::register([
                    'brand' => Color::hex($settings->color)
                ]);
                $panel->brandLogo($settings->logo);
                $panel->brandName($settings->name);
            })
            ->path('')
            ->login()
            ->registration()
            ->topNavigation()
            ->brandLogoHeight('auto')
            ->colors(['primary' => Color::Indigo])
            ->viteTheme('resources/css/app.css')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
