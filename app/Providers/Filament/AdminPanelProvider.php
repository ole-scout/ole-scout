<?php

namespace App\Providers\Filament;

use App\Settings\BrandingSettings;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use FossHaas\Consent\Http\Middleware\ConsensualCookies;
use FossHaas\Support\Http\Middleware\AutoLocale;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $appModulesPath = base_path(config('app-modules.modules_directory'));
        $appModulesNamespace = config('app-modules.modules_namespace');
        $panel
            ->id('admin')
            ->bootUsing(function (Panel $panel) {
                $settings = app(BrandingSettings::class);
                \Filament\Support\Facades\FilamentColor::register([
                    'brand' => Color::hex($settings->brandColor),
                    'primary' => Color::hex($settings->primaryColor),
                ]);
                $panel->brandLogo($settings->logo);
                $panel->brandName($settings->name);
            })
            ->plugin(
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(array_keys(config('support.locales')))
            )
            ->path('admin')
            ->login(false)
            ->brandLogoHeight('auto')
            ->viteTheme('resources/css/filament.css')
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
            );

        $kebab2studly = fn(string $kebab) => str_replace(' ', '', ucwords(
            str_replace('-', ' ', $kebab)
        ));

        foreach (array_diff(scandir($appModulesPath), ['.', '..']) as $moduleName) {
            $modulePath = $appModulesPath . '/' . $moduleName . '/src';
            $namespace = $appModulesNamespace . '\\' . $kebab2studly($moduleName);
            $panel
                ->discoverResources(
                    in: $modulePath . '/Filament/Resources',
                    for: $namespace . '\\Filament\\Resources'
                )
                ->discoverPages(
                    in: $modulePath . '/Filament/Pages',
                    for: $namespace . '\\Filament\\Pages'
                )
                ->discoverWidgets(
                    in: $modulePath . '/Filament/Widgets',
                    for: $namespace . '\\Filament\\Widgets'
                );
        }

        $panel
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
                PanelsRenderHook::STYLES_AFTER,
                fn(): string => Blade::render("@vite('resources/css/filament.css')"),
            )
            ->renderHook(
                PanelsRenderHook::FOOTER,
                fn(): string => Blade::render("<x-core-ui::footer />"),
            )
            ->middleware([
                ConsensualCookies::class,
                AutoLocale::class,
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
        return $panel;
    }
}
