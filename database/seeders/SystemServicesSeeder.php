<?php

namespace Database\Seeders;

use App\Settings\SystemSettings;
use FossHaas\Consent\Category;
use FossHaas\Consent\CookieType;
use FossHaas\Consent\Models\ServiceCookie;
use FossHaas\Consent\Models\ServiceDefinition;
use FossHaas\Consent\Models\ServiceProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SystemServicesSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(SystemSettings $settings): void
    {
        $modified = false;
        if (!$settings->core_service_id) {
            $coreService = new ServiceDefinition([
                'category' => Category::essential,
                'service_provider_id' => null,
            ]);
            $coreService->setTranslation('name', config('app.locale'), config('app.name'));
            $coreService->setTranslation('description', 'en', '');
            $coreService->setTranslation('description', 'de', '');
            $coreService->setTranslation('description', 'fr', '');
            $coreService->setTranslation('description', 'it', '');
            $coreService->save();
            $settings->core_service_id = $coreService->id;
            $modified = true;
        }

        if (!$settings->youtube_service_id) {
            $youTubeProvider = new ServiceProvider([
                'name' => 'Google Ireland Limited',
                'address' => 'Gordon House, Barrow Street, Dublin 4, Ireland',
            ]);
            $youTubeProvider->setTranslation('phone', 'de', '+353 1 543 1000');
            $youTubeProvider->setTranslation('phone', 'en', '+1 650 253 0000');
            $youTubeProvider->setTranslation('email', 'de', 'support-deutschland@google.com');
            $youTubeProvider->setTranslation('email', 'en', 'dpo-google@google.com');
            $youTubeProvider->setTranslation('imprint', 'de', 'https://www.youtube.com/t/impressum?hl=de&gl=DE');
            $youTubeProvider->setTranslation('contact', 'en', 'https://www.youtube.com/t/contact_us');
            $youTubeProvider->setTranslation('privacy_policy', 'en', 'https://policies.google.com/privacy');
            $youTubeProvider->save();

            $youTubeService = new ServiceDefinition([
                'category' => Category::functional,
                'service_provider_id' => $youTubeProvider->id,
            ]);
            $youTubeService->setTranslation('name', 'en', 'YouTube');
            $youTubeService->setTranslation('description', 'en', "YouTube embeds allow displaying YouTube videos directly in the app without the need to click a link to visit the external YouTube website by using YouTube embeds.\n\nYouTube embeds track user interactions, such as playbacks and preferences, to enhance the viewing experience and maintain user sessions. They also enable YouTube to collect data for analytics, personalized ads, and content recommendations.\n\nWhen a YouTube embed is loaded, Google processes personal data, including the user's IP address, device information, browsing history, and interaction data (e.g., video views and clicks). This data is used to personalize content and ads, perform analytics, and ensure the proper functioning of YouTube services. As a result, users may be tracked across websites, contributing to Google's broader data collection for its advertising network.");
            $youTubeService->setTranslation('description', 'de', "Mithilfe von YouTube-Embeds können YouTube-Videos direkt in der App angezeigt werden, ohne dass auf einen Link geklickt werden muss, um die externe YouTube-Website zu besuchen.\n\nYouTube-Embeds verfolgen Nutzerinteraktionen, wie Wiedergaben und Einstellungen, um die Benutzererfahrung zu verbessern und Nutzersitzungen aufrechtzuerhalten. Sie ermöglichen es YouTube auch, Daten für Analysen, personalisierte Werbung und Inhaltsvorschläge zu sammeln.\n\nWenn ein YouTube-Embed geladen wird, verarbeitet Google persönliche Daten, einschließlich der IP-Adresse des Nutzers, Geräteinformationen, Browserverlauf und Interaktionsdaten (z.B. Videoaufrufe und Klicks). Diese Daten werden genutzt, um Inhalte und Werbung zu personalisieren, Analysen durchzuführen und den ordnungsgemäßen Betrieb der YouTube-Dienste sicherzustellen. Dadurch können Nutzer über Websites hinweg verfolgt werden, was zur breiteren Datenerfassung von Google für sein Werbenetzwerk beiträgt.");
            $youTubeService->setTranslation('description', 'fr', "YouTube permet d'afficher des vidéos YouTube directement dans l'application sans avoir à cliquer sur un lien pour visiter le site Web externe de YouTube en utilisant des intégrations YouTube.\n\nLes intégrations YouTube suivent les interactions des utilisateurs, telles que les lectures et les préférences, pour améliorer l'expérience de visionnage et maintenir les sessions utilisateur. Elles permettent également à YouTube de collecter des données à des fins d'analyse, de publicités personnalisées et de recommandations de contenu.\n\nLorsqu'une intégration YouTube est chargée, Google traite des données personnelles, notamment l'adresse IP de l'utilisateur, les informations sur l'appareil, l'historique de navigation et les données d'interaction (par exemple, les vues et les clics sur les vidéos). Ces données sont utilisées pour personnaliser le contenu et les publicités, effectuer des analyses et assurer le bon fonctionnement des services YouTube. Par conséquent, les utilisateurs peuvent être suivis sur plusieurs sites Web, contribuant ainsi à la collecte de données plus large de Google pour son réseau publicitaire.");
            $youTubeService->setTranslation('description', 'it', "YouTube consente di visualizzare i video di YouTube direttamente nell'app senza la necessità di fare clic su un link per visitare il sito web esterno di YouTube utilizzando le incorporazioni di YouTube.\n\nLe incorporazioni di YouTube tracciano le interazioni degli utenti, come le riproduzioni e le preferenze, per migliorare l'esperienza di visualizzazione e mantenere le sessioni degli utenti. Inoltre, permettono a YouTube di raccogliere dati per analisi, annunci personalizzati e raccomandazioni di contenuti.\n\nQuando viene caricata un'incorporazione di YouTube, Google elabora i dati personali, inclusi l'indirizzo IP dell'utente, le informazioni sul dispositivo, la cronologia di navigazione e i dati di interazione (ad esempio, visualizzazioni di video e clic). Questi dati vengono utilizzati per personalizzare i contenuti e gli annunci, effettuare analisi e garantire il corretto funzionamento dei servizi di YouTube. Di conseguenza, gli utenti possono essere tracciati su diversi siti web, contribuendo alla raccolta più ampia di dati da parte di Google per la sua rete pubblicitaria.");
            $youTubeService->save();

            ServiceCookie::factory()->forEachSequence(...Arr::map([
                [CookieType::cookie, 'SIDCC', '.google.com', ['years', 1]],
                [CookieType::cookie, 'NID', '.google.com', ['months', 6]],
                [CookieType::cookie, 'YSC', '.youtube.com', 'session'],
                [CookieType::cookie, 'VISITOR_INFO1_LIVE', '.youtube.com', ['months', 6]],
                [CookieType::cookie, 'PREF', '.youtube.com', ['years', 1]],
                [CookieType::cookie, 'LOGIN_INFO', '.youtube.com', ['months', 13]],
                [CookieType::cookie, 'CONSENT', '.youtube.com', ['months', 9]],
                [CookieType::cookie, 'CONSENT', '.google.com', ['months', 9]],
                [CookieType::cookie, '__Secure-3PAPISID', '.google.com', ['months', 13]],
                [CookieType::cookie, 'SAPISID', '.google.com', ['months', 13]],
                [CookieType::cookie, 'APISID', '.google.com', ['months', 13]],
                [CookieType::cookie, 'HSID', '.google.com', ['months', 13]],
                [CookieType::cookie, '__Secure-3PSID', '.google.com', ['months', 13]],
                [CookieType::cookie, '__Secure-3PAPISID', '.youtube.com', ['months', 13]],
                [CookieType::cookie, 'SAPISID', '.youtube.com', ['months', 13]],
                [CookieType::cookie, 'HSID', '.youtube.com', ['months', 13]],
                [CookieType::cookie, 'SSID', '.google.com', ['months', 13]],
                [CookieType::cookie, 'SID', '.google.com', ['months', 13]],
                [CookieType::cookie, 'SSID', '.youtube.com', ['months', 13]],
                [CookieType::cookie, 'APISID', '.youtube.com', ['months', 13]],
                [CookieType::cookie, '__Secure-3PSID', '.youtube.com', ['months', 13]],
                [CookieType::cookie, 'SID', '.youtube.com', ['months', 13]],
                [CookieType::cookie, 'OTZ', 'www.google.com', ['days', 1]],
                [CookieType::cookie, 'IDE', '.doubleclick.net', ['months', 9]],
                [CookieType::cookie, 'SOCS', '.youtube.com', ['months', 9]],
                [CookieType::cookie, 'SOCS', '.google.com', ['months', 9]],
                [CookieType::local_storage, 'yt-remote-device-id', 'https://www.youtube.com', 'indefinite'],
                [CookieType::local_storage, 'yt-player-headers-readable', 'https://www.youtube.com', 'indefinite'],
                [CookieType::local_storage, 'ytidb::LAST_RESULT_ENTRY_KEY', 'https://www.youtube.com', 'indefinite'],
                [CookieType::local_storage, 'yt-fullerscreen-edu-button-shown-count', 'https://www.youtube.com', 'indefinite'],
                [CookieType::local_storage, 'yt-remote-connected-devices', 'https://www.youtube.com', 'indefinite'],
                [CookieType::local_storage, 'yt-player-bandwidth', 'https://www.youtube.com', 'indefinite'],
                [CookieType::indexed_db, 'LogsDatabaseV2:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::indexed_db, 'ServiceWorkerLogsDatabase', 'https://www.youtube.com', 'indefinite'],
                [CookieType::indexed_db, 'YtldbMeta', 'https://www.youtube.com', 'indefinite'],
                [CookieType::cookie, '__Secure-YEC', '.youtube.com', ['years', 1]],
                [CookieType::cookie, 'test_cookie', '.doubleclick.net', ['days', 1]],
                [CookieType::local_storage, 'yt-player-quality', 'https://www.youtube.com', 'indefinite'],
                [CookieType::local_storage, 'yt-player-performance-cap', 'https://www.youtube.com', 'indefinite'],
                [CookieType::local_storage, 'yt-player-volume', 'https://www.youtube.com', 'indefinite'],
                [CookieType::indexed_db, 'PersistentEntityStoreDb:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::indexed_db, 'yt-idb-pref-storage:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::local_storage, 'yt.innertube::nextId', 'https://www.youtube.com', 'indefinite'],
                [CookieType::local_storage, 'yt.innertube::requests', 'https://www.youtube.com', 'indefinite'],
                [CookieType::local_storage, 'yt-html5-player-modules::subtitlesModuleData::module-enabled', 'https://www.youtube.com', 'indefinite'],
                [CookieType::session_storage, 'yt-remote-session-app', 'https://www.youtube.com', 'session'],
                [CookieType::session_storage, 'yt-remote-cast-installed', 'https://www.youtube.com', 'session'],
                [CookieType::session_storage, 'yt-player-volume', 'https://www.youtube.com', 'session'],
                [CookieType::session_storage, 'yt-remote-session-name', 'https://www.youtube.com', 'session'],
                [CookieType::session_storage, 'yt-remote-cast-available', 'https://www.youtube.com', 'session'],
                [CookieType::session_storage, 'yt-remote-fast-check-period', 'https://www.youtube.com', 'session'],
                [CookieType::local_storage, '*||::yt-player::yt-player-lv', 'https://www.youtube.com', 'indefinite'],
                [CookieType::indexed_db, 'swpushnotificationsdb', 'https://www.youtube.com', 'indefinite'],
                [CookieType::indexed_db, 'yt-player-local-media:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::indexed_db, 'yt-it-response-store:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::cookie, '__HOST-GAPS', 'accounts.google.com', ['months', 13]],
                [CookieType::cookie, 'OTZ', 'accounts.google.com', ['days', 1]],
                [CookieType::cookie, '__Secure-1PSIDCC', '.google.com', ['years', 1]],
                [CookieType::cookie, '__Secure-1PAPISID', '.google.com', ['years', 1]],
                [CookieType::cookie, '__Secure-3PSIDCC', '.youtube.com', ['years', 1]],
                [CookieType::cookie, '__Secure-1PAPISID', '.youtube.com', ['months', 13]],
                [CookieType::cookie, '__Secure-1PSID', '.youtube.com', ['months', 13]],
                [CookieType::cookie, '__Secure-3PSIDCC', '.google.com', ['years', 1]],
                [CookieType::cookie, '__Secure-ENID', '.google.com', ['years', 1]],
                [CookieType::cookie, 'AEC', '.google.com', ['months', 6]],
                [CookieType::cookie, '__Secure-1PSID', '.google.com', ['months', 13]],
                [CookieType::indexed_db, 'ytGefConfig:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::cookie, '__Host-3PLSID', 'accounts.google.com', ['months', 13]],
                [CookieType::cookie, 'LSID', 'accounts.google.com', ['months', 13]],
                [CookieType::cookie, 'ACCOUNT_CHOOSER', 'accounts.google.com', ['months', 13]],
                [CookieType::cookie, '__Host-1PLSID', 'accounts.google.com', ['months', 13]]
            ], fn($values) => [
                ...array_combine(['type', 'name', 'host', 'duration'], $values),
                'description' => [],
                'service_definition_id' => $youTubeService->id,
            ]))->create();

            $settings->youtube_service_id = $youTubeService->id;
            $modified = true;
        }

        if ($modified) {
            $settings->save();
        }
    }
}
