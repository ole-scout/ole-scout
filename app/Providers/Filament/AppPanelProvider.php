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
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
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
            ->colors([
                'primary' => Color::Indigo
            ])
            ->viteTheme('resources/css/app.css')
            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\\Filament\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Pages'),
                for: 'App\\Filament\\Pages'
            )
            ->discoverWidgets(
                in: app_path('Filament/Widgets'),
                for: 'App\\Filament\\Widgets'
            )
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->renderHook(
                PanelsRenderHook::SCRIPTS_AFTER,
                fn(): string => Blade::render(
                    "@unlessconsentgiven\n<x-consent::consent-modal />\n@endconsentgiven"
                ),
            )
            ->renderHook(
                PanelsRenderHook::SCRIPTS_AFTER,
                fn(): string => Blade::render("@vite('resources/js/app.js')"),
            )
            ->renderHook(
                PanelsRenderHook::STYLES_AFTER,
                fn(): string => Blade::render("@vite('resources/css/app.css')"),
            )
            ->renderHook(
                PanelsRenderHook::FOOTER,
                fn(): string => Blade::render("<x-core.footer />"),
            )
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
