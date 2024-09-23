<?php

namespace App\Filament\Pages;

use App\Settings\BrandingSettings;
use Filament\Forms\Form;
use Filament\Forms\Components as Forms;
use Filament\Forms\Set;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components as Infolists;
use Filament\Pages\Page;
use FossHaas\Consent\Settings\ServiceProviderSettings;
use FossHaas\Support\PhoneNumber as PhoneNumberHelper;
use Illuminate\Support\HtmlString;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditAppSettings extends Page
{
    protected static ?string $navigationIcon = 'fluentui-content-settings-20';

    protected static string $view = 'filament.pages.edit-app-settings';

    public static function getNavigationLabel(): string
    {
        return __('Settings');
    }

    public function getTitle(): string
    {
        return static::getNavigationLabel();
    }

    protected function getServiceProviderSettings(): array
    {
        return app(ServiceProviderSettings::class)->toArray();
    }

    public function serviceProviderForm(Form $form): Form
    {
        return $form
            ->live()
            ->schema([
                Forms\TextInput::make('name')
                    ->columnSpan(3)
                    ->label(__('Service provider name'))
                    ->required()
                    ->placeholder(__('Contoso Ltd.')),
                Forms\TextInput::make('address')
                    ->columnSpan(3)
                    ->label(__('Postal address')),
                Forms\TextInput::make('email')
                    ->columnSpan(2)
                    ->label(__('Email address'))
                    ->email(),
                Forms\TextInput::make('phone')
                    ->label(__('Phone number'))
                    ->placeholder(__('+49 123 4567890'))
                    ->live(debounce: 500)
                    ->validationAttribute(__('Phone number'))
                    ->rules(fn(): \Closure => function (string $attribute, $value, \Closure $fail) {
                        if (!str_starts_with($value, '+')) {
                            $fail(__(':attribute does not contain a country code.'));
                            return;
                        }
                        if (preg_match('/[^-+\s0-9]+/', $value, $matches)) {
                            $fail(__(':attribute contains invalid characters: ":match"', ['match' => $matches[0]]));
                            return;
                        }
                        if (!preg_match('/^[+][1-9]([-\s]?[0-9])+$/i', $value)) {
                            $fail(__(':attribute is not a well-formed phone number.'));
                            return;
                        }
                    })
                    ->afterStateUpdated(
                        function (?string $state, Set $set) {
                            if (!$state) return;
                            $formatted = $state;
                            if (str_starts_with($formatted, '00')) {
                                $formatted = '+' . substr($state, 2);
                            }
                            try {
                                $formatted = PhoneNumberHelper::format($formatted);
                            } catch (\Exception $e) {
                                // pass
                            }
                            if ($state !== $formatted) {
                                $set('phone', $formatted);
                            }
                        }
                    ),
            ]);
    }

    public function serviceProviderInfolist(Infolist $infolist): Infolist
    {
        $state = $this->getServiceProviderSettings();
        return $infolist
            ->state($state)
            ->schema([
                Infolists\Section::make(__('Privacy Information'))
                    ->compact()
                    ->columns(3)
                    ->headerActions([
                        Infolists\Actions\Action::make('edit')
                            ->label(__('Edit'))
                            ->icon('heroicon-o-pencil')
                            ->size('sm')
                            ->fillForm($state)
                            ->form(fn(Form $form) => $this->serviceProviderForm($form))
                            ->action(function (array $data) {
                                $settings = app(ServiceProviderSettings::class);
                                $settings->fill($data);
                                $settings->save();
                            })
                    ])
                    ->schema([
                        Infolists\TextEntry::make('name')
                            ->columnSpan(3)
                            ->label(__('Service provider name')),
                        Infolists\TextEntry::make('address')
                            ->columnSpan(3)
                            ->label(__('Postal address')),
                        Infolists\TextEntry::make('email')
                            ->columnSpan(2)
                            ->label(__('Email address')),
                        Infolists\TextEntry::make('phone')
                            ->label(__('Phone number')),
                    ])
            ]);
    }

    protected function getBrandingSettings(): array
    {
        return app(BrandingSettings::class)->toArray();
    }

    public function brandingForm(Form $form): Form
    {
        return $form
            ->live()
            ->columns(2)
            ->schema([
                Forms\Grid::make()
                    ->columnSpan(1)
                    ->columns(1)
                    ->schema([
                        Forms\TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),
                        Forms\FileUpload::make('logo')
                            ->label(__('Logo'))
                            ->image()
                            ->imageResizeMode('contain')
                            ->imageResizeUpscale(false)
                            ->imageResizeTargetWidth('288')
                            ->imageResizeTargetHeight('80')
                            ->imagePreviewHeight('80')
                            ->disk('fake')
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string => data_uri($file)
                            )
                            ->required(false),
                    ]),
                Forms\Fieldset::make(__('Colors'))
                    ->columnSpan(1)
                    ->columns(2)
                    ->schema([
                        Forms\ColorPicker::make('brandColor')
                            ->columnSpan(1)
                            ->label(__('Brand color'))
                            ->required(),
                        Forms\ColorPicker::make('primaryColor')
                            ->columnSpan(1)
                            ->label(__('Accent color'))
                            ->required(),
                    ]),
            ]);
    }

    public function brandingInfolist(Infolist $infolist): Infolist
    {
        $state = $this->getBrandingSettings();
        $appName = htmlspecialchars(config('app.name'));
        return $infolist
            ->state($state)
            ->schema([
                Infolists\Section::make(__('Design'))
                    ->compact()
                    ->columns(2)
                    ->headerActions([
                        Infolists\Actions\Action::make('edit')
                            ->label(__('Edit'))
                            ->icon('heroicon-o-pencil')
                            ->size('sm')
                            ->fillForm($state)
                            ->form(fn(Form $form) => $this->brandingForm($form))
                            ->action(function (array $data) {
                                $settings = app(BrandingSettings::class);
                                $settings->fill($data);
                                $settings->save();
                            })
                    ])
                    ->schema([
                        Infolists\Grid::make()
                            ->columnSpan(1)
                            ->columns(1)
                            ->schema([
                                Infolists\TextEntry::make('name')
                                    ->label(__('Name')),
                                Infolists\ImageEntry::make('logo')
                                    ->label(__('Logo'))
                                    ->extraAttributes(['class' => 'bg-brand-500 dark:bg-brand-500 text-white dark:text-white max-w-72 h-28 p-4 rounded-lg'])
                                    ->placeholder(new HtmlString(
                                        "<span class=\"text-white text-xl font-bold leading-5 tracking-tight\">$appName</span>"
                                    ))
                                    ->height(80),
                            ]),
                        Infolists\Fieldset::make(__('Colors'))
                            ->columnSpan(1)
                            ->columns(2)
                            ->schema([
                                Infolists\ColorEntry::make('brandColor')
                                    ->columnSpan(1)
                                    ->label(__('Brand color')),
                                Infolists\ColorEntry::make('primaryColor')
                                    ->columnSpan(1)
                                    ->label(__('Accent color')),
                            ]),
                    ])
            ]);
    }
}
