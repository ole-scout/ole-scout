<?php

namespace FossHaas\Consent\Livewire;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\Markdown;
use FossHaas\Consent\Category;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;

class CookieConsent extends Component implements HasForms
{
    use InteractsWithForms;

    public array $services = [];

    public ?array $data = [];

    public function __construct()
    {
        $services = [
            [
                'id' => '_system',
                'category' => 'essential',
                'name' => 'OLE Scout',
                'description' => 'OLE Scout setzt Cookies ein, um eingeloggte Benutzer zu identifizieren, Ihre Sitzung gegen Identitätsdiebstahl (CSRF) zu schützen und Ihre Privatsphäre-Einstellungen zu speichern.',
                'provider' => [
                    'name' => 'Contoso Ltd',
                    'address' => '2301 Arely Ports, RI 75911, Johannside, Maldives',
                    'privacyPolicy' => '/privacy',
                    'imprint' => '/imprint',
                    'contact' => '/contact',
                    'email' => 'Kaitlyn.Jenkins@gmail.com',
                    'phone' => '+17168292024',
                ],
                'cookies' => [
                    [
                        'name' => 'laravel_session',
                        'type' => 'cookie',
                        'duration' => '1 Monat',
                        'content' => 'Eindeutige Session-ID zur Identifikation eines eingeloggten Benutzers.',
                        'purpose' => 'Verknüpfung von Anfragen und Interaktionen mit dem eingeloggten Benutzer.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. b',
                    ],
                    [
                        'name' => 'XSRF-TOKEN',
                        'type' => 'cookie',
                        'duration' => '1 Monat',
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. f',
                    ],
                    [
                        'name' => 'consent',
                        'type' => 'cookie',
                        'duration' => '30 Tage',
                        'content' => 'Aut recusandae repellendus quas voluptatum non est eaque.',
                        'purpose' => 'Est delectus voluptatem quia praesentium voluptatem.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. f',
                    ],
                    [
                        'name' => 'state:*',
                        'type' => 'local_storage',
                        'duration' => 'Kein Ablauf',
                        'content' => 'Gerätespezifische Einstellungen und temporäre Daten, z.B. Lautstärke, Wiedergabegeschwindigkeit.',
                        'purpose' => 'Persistierung lokaler Einstellungen.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. f',
                    ],
                    [
                        'name' => 'consent',
                        'type' => 'local_storage',
                        'duration' => 'Kein Ablauf',
                        'content' => 'Privatsphäre-Einstellungen.',
                        'purpose' => 'Persistierung der Privatsphäre-Einstellungen über mehrere Besuche hinweg.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. c',
                    ],
                ],
            ],
            [
                'id' => 'google-fonts',
                'category' => 'functional',
                'name' => 'Google Fonts',
                'description' => 'Google Fonts ermöglicht die Einbindung von Schriftarten auf dieser Webseite.',
                'provider' => [
                    'name' => 'Google Ireland Limited',
                    'address' => 'Gordon House, Barrow Street, Dublin 4, Irland',
                    'privacyPolicy' => 'https://policies.google.com/privacy',
                    'imprint' => 'https://www.google.de/contact/impressum.html',
                    'contact' => 'https://support.google.com/',
                    'email' => 'dpo-google@google.com',
                    'phone' => '+16502530000',
                ],
                'cookies' => []
            ],
            [
                'id' => 'matomo',
                'category' => 'analytics',
                'name' => 'Matomo',
                'description' => 'Matomo verwendet Cookies, um pseudonymisierte Benutzerprofile zu erzeugen, die Aufschluss über das Nutzungsverhalten über mehrere Besuche hinweg geben können.',
                'provider' => [
                    'name' => 'Contoso Ltd',
                    'address' => '2301 Arely Ports, RI 75911, Johannside, Maldives',
                    'privacyPolicy' => '/privacy',
                    'imprint' => '/imprint',
                    'contact' => '/contact',
                    'email' => 'Kaitlyn.Jenkins@gmail.com',
                    'phone' => '+17168292024',
                ],
                'cookies' => [
                    [
                        'name' => 'pk_id',
                        'type' => 'cookie',
                        'duration' => '13 Monate',
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. a',
                    ],
                    [
                        'name' => 'pk_ses',
                        'type' => 'cookie',
                        'duration' => '30 Minuten',
                        'content' => 'Aut recusandae repellendus quas voluptatum non est eaque.',
                        'purpose' => 'Est delectus voluptatem quia praesentium voluptatem.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. a',
                    ],
                ],
            ],
            [
                'id' => 'google-analytics',
                'category' => 'analytics',
                'name' => 'Google Analytics',
                'description' => 'Google Analytics verwendet Cookies, um pseudonymisierte Benutzerprofile zu erzeugen, die Aufschluss über das Nutzungsverhalten über mehrere Besuche hinweg geben können.',
                'provider' => [
                    'name' => 'Google Ireland Limited',
                    'address' => 'Gordon House, Barrow Street, Dublin 4, Irland',
                    'privacyPolicy' => 'https://policies.google.com/privacy',
                    'imprint' => 'https://www.google.de/contact/impressum.html',
                    'contact' => 'https://support.google.com/',
                    'email' => 'dpo-google@google.com',
                    'phone' => '+16502530000',
                ],
                'cookies' => [
                    [
                        'name' => '_ga',
                        'type' => 'cookie',
                        'duration' => '2 Jahre',
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. a',
                    ],
                    [
                        'name' => '_gid',
                        'type' => 'cookie',
                        'duration' => '24 Stunden',
                        'content' => 'Aut recusandae repellendus quas voluptatum non est eaque.',
                        'purpose' => 'Est delectus voluptatem quia praesentium voluptatem.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. a',
                    ],
                    [
                        'name' => '_gat',
                        'type' => 'cookie',
                        'duration' => '1 Minute',
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. a',
                    ],
                ],
            ],
            [
                'id' => 'google-ads',
                'category' => 'marketing',
                'name' => 'Google Ads',
                'description' => 'Google Ads verwendet Cookies, um pseudonymisierte Benutzerprofile zu erzeugen, die Aufschluss über das Nutzungsverhalten über mehrere Besuche hinweg geben können.',
                'provider' => [
                    'name' => 'Google Ireland Limited',
                    'address' => 'Gordon House, Barrow Street, Dublin 4, Irland',
                    'privacyPolicy' => 'https://policies.google.com/privacy',
                    'imprint' => 'https://www.google.de/contact/impressum.html',
                    'contact' => 'https://support.google.com/',
                    'email' => 'dpo-google@google.com',
                    'phone' => '+16502530000',
                ],
                'cookies' => [
                    [
                        'name' => 'IDE',
                        'type' => 'cookie',
                        'duration' => '1 Jahr',
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. a',
                    ],
                    [
                        'name' => 'test_cookie',
                        'type' => 'cookie',
                        'duration' => '15 Minuten',
                        'content' => 'Aut recusandae repellendus quas voluptatum non est eaque.',
                        'purpose' => 'Est delectus voluptatem quia praesentium voluptatem.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. a',
                    ],
                ],
            ],
            [
                'id' => 'facebook',
                'category' => 'marketing',
                'name' => 'Facebook',
                'description' => 'Facebook verwendet Cookies, um pseudonymisierte Benutzerprofile zu erzeugen, die Aufschluss über das Nutzungsverhalten über mehrere Besuche hinweg geben können.',
                'provider' => [
                    'name' => 'Meta Platforms Ireland Limited',
                    'address' => '4 Grand Canal Square Grand Canal Harbour, Dublin 2, Irland',
                    'privacyPolicy' => 'https://www.facebook.com/about/privacy',
                    'contact' => 'https://www.facebook.com/business/help',
                    'email' => 'support@fb.com',
                ],
                'cookies' => [
                    [
                        'name' => 'fr',
                        'type' => 'cookie',
                        'duration' => '3 Monate',
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. a',
                    ],
                    [
                        'name' => 'tr',
                        'type' => 'cookie',
                        'duration' => 'Session',
                        'content' => 'Aut recusandae repellendus quas voluptatum non est eaque.',
                        'purpose' => 'Est delectus voluptatem quia praesentium voluptatem.',
                        'legalBasis' => 'DSGVO Art. 6 Abs. 1 lit. a',
                    ],
                ],
            ],
        ];
        foreach ($services as $service) {
            if (!isset($this->services[$service['category']])) {
                $this->services[$service['category']] = [];
            }
            $this->services[$service['category']][] = $service;
            $this->data[$service['id']] = $service['category'] === 'essential';
        }
    }

    public function mount(): void
    {
        $this->form->fill([
            '_categories' => ['essential' => true],
            '_system' => true,
            ...$this->data
        ]);
    }

    protected function categoriesCheckboxes()
    {
        return Grid::make()
            ->extraAttributes(['class' => 'px-4'])
            ->columns(['sm' => 2, 'md' => 5, 'lg' => 5])
            ->schema([
                Actions::make([
                    Actions\Action::make('select-all')
                        ->label(__('Alle auswählen'))
                        ->link()
                        ->hidden(fn (Get $get): bool => (
                            Arr::first(
                                Category::names(),
                                fn (string $category) => !$get('_categories.' . $category)
                            ) === null
                        ))
                        ->action(function (Component $livewire, Set $set) {
                            foreach (Category::names() as $category) {
                                $set('_categories.' . $category, true);
                            }
                            foreach ($livewire->services as $services) {
                                foreach ($services as $service) {
                                    $set($service['id'], true);
                                }
                            }
                        }),
                ])
                    ->columnSpan(['sm' => 2, 'md' => 1]),
                ...Arr::map(
                    Category::cases(),
                    fn (Category $category) => Checkbox::make('_categories.' . $category->name)
                        ->label($category->label())
                        ->disabled($category === Category::essential)
                        ->afterStateUpdated(function (?bool $state, Component $livewire, Set $set) use ($category) {
                            if ($state === null) return;
                            foreach ($livewire->services[$category->name] as $service) {
                                $set($service['id'], $state);
                            }
                        })
                        ->live()
                )
            ]);
    }

    protected function categoryTab(Category $category)
    {
        return Tabs\Tab::make($category->label())
            ->badge(fn (Component $livewire, Get $get) => (
                count(Arr::where(
                    $livewire->services[$category->name],
                    fn (array $service) => $get($service['id'])
                )) ?: null
            ))
            ->schema(
                Arr::map(
                    $this->services[$category->name],
                    fn (array $service) => $this->serviceFields($category, $service)
                )
            );
    }

    protected function serviceFields(Category $category, $service)
    {
        return Fieldset::make($service['name'])
            ->hiddenLabel()
            ->columns(['default' => 1, 'lg' => 2])
            ->schema(Arr::whereNotNull([
                Split::make([
                    Grid::make()->columns(1)->schema(Arr::whereNotNull([
                        Toggle::make($service['id'])
                            ->label($service['name'])
                            ->disabled($service['category'] === 'essential')
                            ->helperText($service['description'])
                            ->live()
                            ->afterStateUpdated(function (?bool $state, Component $livewire, Set $set, Get $get) use ($category) {
                                if ($state === null) return;
                                if (!$state) {
                                    $set('_categories.' . $category->name, false);
                                } else if (
                                    !Arr::first(
                                        $livewire->services[$category->name],
                                        fn (array $service) => !$get($service['id'])
                                    )
                                ) {
                                    $set('_categories.' . $category->name, true);
                                }
                            }),
                        array_key_exists('provider', $service) ? Livewire::make(
                            ProviderDetails::class,
                            ['provider' => $service['provider']]
                        )->key($service['id'] . '-provider') : null
                    ]))
                ]),
                array_key_exists('cookies', $service) && !empty($service['cookies']) ? Livewire::make(
                    CookieDetails::class,
                    ['cookies' => $service['cookies']]
                )->key($service['id'] . '-details') : null
            ]));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('intro')
                    ->hiddenLabel()
                    ->content(new Markdown(__("Diese Anwendung verwendet Cookies und ähnliche Technologien und verarbeitet personenbezogene Daten von Ihnen (z.B. IP-Adresse), um Inhalte und Funktionen zur Verfügung zu stellen oder Zugriffe zu analysieren.\n\nSie haben an dieser Stelle die Möglichkeit, Ihre Einwilligung in die Verarbeitung Ihrer personenbezogenen Daten zu bestimmten Zwecken zu erteilen. Sie können diese Einwilligung jederzeit widerrufen. Weitere Informationen zu Ihren Rechten und zur Verwendung Ihrer Daten finden Sie in der [Datenschutzerklärung](/privacy)."))),
                $this->categoriesCheckboxes(),
                Tabs::make()
                    ->tabs(Arr::map(
                        Category::cases(),
                        fn (Category $category) => $this->categoryTab($category)
                    ))
            ])
            ->statePath('data');
    }

    public function save(bool $acceptAll = false): void
    {
        $data = $this->form->getState();

        dd([
            'data' => $this->data,
            'state' => $data,
            'acceptAll' => $acceptAll
        ]);
    }

    public function render(): View
    {
        return view('consent::livewire.cookie-consent');
    }
}
