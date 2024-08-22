<?php

namespace App\Filament\Pages;

use App\Settings\BrandingSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ManageBranding extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = BrandingSettings::class;

    public static function getNavigationLabel(): string
    {
        return __('Branding');
    }

    public function getHeading(): string
    {
        return __('Branding');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),
                Forms\Components\ColorPicker::make('color')
                    ->label(__('Farbe'))
                    ->required(),
                Forms\Components\FileUpload::make('logo')
                    ->label(__('Logo'))
                    ->image()
                    ->imageResizeMode('contain')
                    ->imageResizeUpscale(false)
                    ->imageResizeTargetWidth('288')
                    ->imageResizeTargetHeight('80')
                    ->imagePreviewHeight('80')
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => 'logo.' . $file->guessExtension() ?? 'png'
                    )
                    ->required(false),
            ]);
    }
}
