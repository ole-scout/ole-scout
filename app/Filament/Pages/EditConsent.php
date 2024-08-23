<?php

namespace App\Filament\Pages;

use App\HasIconHeading;
use Filament\Pages\Page;

class EditConsent extends Page
{
    use HasIconHeading;

    protected static ?string $navigationIcon = 'fluentui-shield-person-20';

    protected static string $view = 'filament.pages.edit-consent';

    protected static ?string $slug = "consent";

    protected static bool $shouldRegisterNavigation = false;

    public static function getNavigationLabel(): string
    {
        return __('Datenschutz-Einstellungen');
    }
}
