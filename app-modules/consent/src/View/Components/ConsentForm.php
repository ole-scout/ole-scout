<?php

namespace FossHaas\Consent\View\Components;

use Closure;
use FossHaas\Consent\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class ConsentForm extends Component
{

    protected array $services = [];

    protected array $selected = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $services = [
            // If the category is "essential", legalBasis can not be "consent"
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
                    'email' => 'Kaitlyn.Jenkins@gmail.com',
                    'phone' => '+17168292024',
                ],
                'cookies' => [
                    [
                        'name' => 'laravel_session',
                        'type' => 'cookie',
                        'duration' => ['months', 1],
                        'content' => 'Eindeutige Session-ID zur Identifikation eines eingeloggten Benutzers.',
                        'purpose' => 'Verknüpfung von Anfragen und Interaktionen mit dem eingeloggten Benutzer.',
                        'legalBasis' => 'legitimate_interest',
                    ],
                    [
                        'name' => 'XSRF-TOKEN',
                        'type' => 'cookie',
                        'duration' => ['months', 1],
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'legitimate_interest',
                    ],
                    [
                        'name' => 'consent',
                        'type' => 'cookie',
                        'duration' => ['days', 30],
                        'content' => 'Aut recusandae repellendus quas voluptatum non est eaque.',
                        'purpose' => 'Est delectus voluptatem quia praesentium voluptatem.',
                        'legalBasis' => 'legal_obligation',
                    ],
                    [
                        'name' => 'state:*',
                        'type' => 'local_storage',
                        'duration' => 'indefinite',
                        'content' => 'Gerätespezifische Einstellungen und temporäre Daten, z.B. Lautstärke, Wiedergabegeschwindigkeit.',
                        'purpose' => 'Persistierung lokaler Einstellungen.',
                        'legalBasis' => 'legitimate_interest',
                    ],
                    [
                        'name' => 'consent',
                        'type' => 'local_storage',
                        'duration' => 'indefinite',
                        'content' => 'Privatsphäre-Einstellungen.',
                        'purpose' => 'Persistierung der Privatsphäre-Einstellungen über mehrere Besuche hinweg.',
                        'legalBasis' => 'legal_obligation',
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
                    'email' => 'Kaitlyn.Jenkins@gmail.com',
                    'phone' => '+17168292024',
                ],
                'cookies' => [
                    [
                        'name' => 'pk_id',
                        'type' => 'cookie',
                        'duration' => ['months', 13],
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'consent',
                    ],
                    [
                        'name' => 'pk_ses',
                        'type' => 'cookie',
                        'duration' => ['minutes', 30],
                        'content' => 'Aut recusandae repellendus quas voluptatum non est eaque.',
                        'purpose' => 'Est delectus voluptatem quia praesentium voluptatem.',
                        'legalBasis' => 'consent',
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
                        'duration' => ['years', 2],
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'consent',
                    ],
                    [
                        'name' => '_gid',
                        'type' => 'cookie',
                        'duration' => ['hours', 24],
                        'content' => 'Aut recusandae repellendus quas voluptatum non est eaque.',
                        'purpose' => 'Est delectus voluptatem quia praesentium voluptatem.',
                        'legalBasis' => 'consent',
                    ],
                    [
                        'name' => '_gat',
                        'type' => 'cookie',
                        'duration' => ['minutes', 1],
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'consent',
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
                        'duration' => ['years', 1],
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'consent',
                    ],
                    [
                        'name' => 'test_cookie',
                        'type' => 'cookie',
                        'duration' => ['minutes', 15],
                        'content' => 'Aut recusandae repellendus quas voluptatum non est eaque.',
                        'purpose' => 'Est delectus voluptatem quia praesentium voluptatem.',
                        'legalBasis' => 'consent',
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
                        'duration' => ['months', 3],
                        'content' => 'Est voluptas molestiae possimus ut maiores qui provident qui esse.',
                        'purpose' => 'Iusto facilis enim amet.',
                        'legalBasis' => 'consent',
                    ],
                    [
                        'name' => 'tr',
                        'type' => 'cookie',
                        'duration' => 'session',
                        'content' => 'Aut recusandae repellendus quas voluptatum non est eaque.',
                        'purpose' => 'Est delectus voluptatem quia praesentium voluptatem.',
                        'legalBasis' => 'consent',
                    ],
                ],
            ],
        ];
        foreach ($services as $service) {
            if (!isset($this->services[$service['category']])) {
                $this->services[$service['category']] = [];
                $this->selected[$service['category']] = [];
            }
            $this->services[$service['category']][] = $service;
            $this->selected[$service['category']][$service['id']] = $service['category'] === 'essential';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('consent::components.consent-form', [
            'categories' => Arr::mapWithKeys(
                Arr::where(
                    Category::cases(),
                    fn (Category $category) => array_key_exists($category->name, $this->services)
                ),
                fn (Category $category) => [$category->name => $category->label()]
            ),
            'selected' => $this->selected,
            'services' => $this->services
        ]);
    }
}
