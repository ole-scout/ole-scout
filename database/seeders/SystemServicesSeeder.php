<?php

namespace Database\Seeders;

use FossHaas\Consent\Enums\Category;
use FossHaas\Consent\Enums\CookieType;
use FossHaas\Consent\Models\ServiceCookie;
use FossHaas\Consent\Models\ServiceDefinition;
use FossHaas\Consent\Models\ServiceProvider;
use FossHaas\Consent\Settings\AppConsentSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SystemServicesSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(AppConsentSettings $settings): void
    {
        $modified = false;
        if (!array_key_exists('core', $settings->service_ids)) {
            $coreService = new ServiceDefinition([
                'category' => Category::ESSENTIAL,
                'service_provider_id' => null,
            ]);
            $coreService->setTranslation('name', config('app.locale'), config('app.name'));
            $coreService->setTranslation('description', 'en', 'This app uses cookies and similar technologies for storing data on your device while using this app. These essential cookies are either necessary for the operation of the app or to protect the security of the data you store and generate in the app.');
            $coreService->setTranslation('description', 'de', 'Diese App verwendet Cookies und ähnliche Technologien, um Daten auf Ihrem Gerät zu speichern, während Sie diese App verwenden. Diese essenziellen Cookies sind entweder für den Betrieb der App erforderlich oder zum Schutz der Sicherheit der Daten, die Sie in der App speichern und generieren.');
            $coreService->setTranslation('description', 'fr', 'Cette application utilise des cookies et des technologies similaires pour stocker des données sur votre appareil pendant que vous utilisez cette application. Ces cookies essentiels sont soit nécessaires au fonctionnement de l\'application, soit pour protéger la sécurité des données que vous stockez et générez dans l\'application.');
            $coreService->setTranslation('description', 'it', 'Questa app utilizza cookie e tecnologie simili per memorizzare dati sul tuo dispositivo durante l\'utilizzo di questa app. Questi cookie essenziali sono necessari per il funzionamento dell\'app o per proteggere la sicurezza dei dati che memorizzi e generi nell\'app.');
            $coreService->setTranslation('description', 'nl', 'Deze app maakt gebruik van cookies en vergelijkbare technologieën om gegevens op uw apparaat op te slaan tijdens het gebruik van deze app. Deze essentiële cookies zijn ofwel noodzakelijk voor de werking van de app, of om de veiligheid van de gegevens die u opslaat en genereert in de app te beschermen.');
            $coreService->setTranslation('description', 'es', 'Esta aplicación utiliza cookies y tecnologías similares para almacenar datos en su dispositivo mientras utiliza esta aplicación. Estas cookies esenciales son necesarias para el funcionamiento de la aplicación o para proteger la seguridad de los datos que almacena y genera en la aplicación.');
            $coreService->save();
            $settings->service_ids['core'] = $coreService->id;
            $modified = true;

            $consentCookie = new ServiceCookie([
                'service_definition_id' => $coreService->id,
                'type' => CookieType::COOKIE,
                'name' => 'consent',
                'host' => null,
                'duration' => ['days', 365],
                'legal_basis' => 'legal_obligation',
            ]);
            $consentCookie->setTranslation('description', 'en', 'This cookie stores your consent to the use of non-essential cookies and similar technologies in the app. It will also be set to indicate that you have been already been informed about the use of cookies and similar technologies in the app to prevent showing you the consent dialog again.');
            $consentCookie->setTranslation('description', 'de', 'Dieser Cookie speichert Ihre Zustimmung zur Verwendung von nicht-essentiellen Cookies und ähnlichen Technologien in der App. Er wird auch gesetzt, um anzuzeigen, dass Sie bereits über die Verwendung von Cookies und ähnlichen Technologien in der App informiert wurden, um zu verhindern, dass Ihnen der Zustimmungsdialog erneut angezeigt wird.');
            $consentCookie->setTranslation('description', 'fr', 'Ce cookie stocke votre consentement à l\'utilisation de cookies et de technologies similaires non essentiels dans l\'application. Il sera également défini pour indiquer que vous avez déjà été informé de l\'utilisation de cookies et de technologies similaires dans l\'application afin d\'éviter de vous montrer à nouveau la boîte de dialogue de consentement.');
            $consentCookie->setTranslation('description', 'it', 'Questo cookie memorizza il tuo consenso all\'utilizzo di cookie e tecnologie simili non essenziali nell\'app. Verrà anche impostato per indicare che sei già stato informato sull\'utilizzo di cookie e tecnologie simili nell\'app per evitare di mostrarti nuovamente il dialogo di consenso.');
            $consentCookie->setTranslation('description', 'nl', 'Deze cookie slaat uw toestemming op voor het gebruik van niet-essentiële cookies en vergelijkbare technologieën in de app. Het wordt ook ingesteld om aan te geven dat u al op de hoogte bent gebracht van het gebruik van cookies en vergelijkbare technologieën in de app om te voorkomen dat u het toestemmingsvenster opnieuw te zien krijgt.');
            $consentCookie->setTranslation('description', 'es', 'Esta cookie almacena su consentimiento para el uso de cookies y tecnologías similares no esenciales en la aplicación. También se establecerá para indicar que ya ha sido informado sobre el uso de cookies y tecnologías similares en la aplicación para evitar mostrarle nuevamente el cuadro de diálogo de consentimiento.');
            $consentCookie->save();

            $xsrfCookie = new ServiceCookie([
                'service_definition_id' => $coreService->id,
                'type' => CookieType::COOKIE,
                'name' => 'XSRF-TOKEN',
                'host' => null,
                'duration' => ['minutes', config('session.lifetime')],
                'legal_basis' => 'legitimate_interest',
            ]);
            $xsrfCookie->setTranslation('description', 'en', 'This cookie is used to protect you from Cross-Site Request Forgery (CSRF) attacks. The value of the cookie is used in some parts of the app to indicate that requests made to the server are legitimate.');
            $xsrfCookie->setTranslation('description', 'de', 'Dieser Cookie wird verwendet, um Sie vor Cross-Site Request Forgery (CSRF)-Angriffen zu schützen. Der Wert des Cookies wird in einigen Teilen der App verwendet, um anzuzeigen, dass Anfragen an den Server legitim sind.');
            $xsrfCookie->setTranslation('description', 'fr', 'Ce cookie est utilisé pour vous protéger contre les attaques de falsification de requête intersite (CSRF). La valeur du cookie est utilisée dans certaines parties de l\'application pour indiquer que les requêtes envoyées au serveur sont légitimes.');
            $xsrfCookie->setTranslation('description', 'it', 'Questo cookie viene utilizzato per proteggerti dagli attacchi di falsificazione di richieste intersito (CSRF). Il valore del cookie viene utilizzato in alcune parti dell\'app per indicare che le richieste inviate al server sono legittime.');
            $xsrfCookie->setTranslation('description', 'nl', 'Deze cookie wordt gebruikt om u te beschermen tegen Cross-Site Request Forgery (CSRF)-aanvallen. De waarde van de cookie wordt in sommige delen van de app gebruikt om aan te geven dat verzoeken aan de server legitiem zijn.');
            $xsrfCookie->setTranslation('description', 'es', 'Esta cookie se utiliza para protegerte de los ataques de falsificación de solicitudes entre sitios (CSRF). El valor de la cookie se utiliza en algunas partes de la aplicación para indicar que las solicitudes enviadas al servidor son legítimas.');
            $xsrfCookie->save();

            $sessionCookie = new ServiceCookie([
                'service_definition_id' => $coreService->id,
                'type' => CookieType::COOKIE,
                'name' => 'ole_scout_session',
                'host' => null,
                'duration' => ['minutes', config('session.lifetime')],
                'legal_basis' => 'legitimate_interest',
            ]);
            $sessionCookie->setTranslation('description', 'en', 'This cookie is used to maintain your identity and session state while using the app and to identify and authorize you while logged in.');
            $sessionCookie->setTranslation('description', 'de', 'Dieser Cookie wird verwendet, um Ihre Identität und den Sitzungszustand während der Nutzung der App aufrechtzuerhalten und Sie zu identifizieren und zu autorisieren, während Sie angemeldet sind.');
            $sessionCookie->setTranslation('description', 'fr', 'Ce cookie est utilisé pour maintenir votre identité et l\'état de la session pendant l\'utilisation de l\'application et pour vous identifier et vous autoriser lorsque vous êtes connecté.');
            $sessionCookie->setTranslation('description', 'it', 'Questo cookie viene utilizzato per mantenere la tua identità e lo stato della sessione durante l\'utilizzo dell\'app e per identificarti e autorizzarti mentre sei connesso.');
            $sessionCookie->setTranslation('description', 'nl', 'Deze cookie wordt gebruikt om uw identiteit en sessiestatus te behouden tijdens het gebruik van de app en om u te identificeren en te autoriseren terwijl u bent ingelogd.');
            $sessionCookie->setTranslation('description', 'es', 'Esta cookie se utiliza para mantener su identidad y estado de sesión mientras utiliza la aplicación y para identificarlo y autorizarlo mientras está conectado.');
            $sessionCookie->save();

            $rememberCookie = new ServiceCookie([
                'service_definition_id' => $coreService->id,
                'type' => CookieType::COOKIE,
                'name' => 'remember_web_*',
                'host' => null,
                // via Illuminate\Auth\SessionGuard::rememberDuration
                'duration' => ['days', 576000 / 60 / 24],
                'legal_basis' => 'contract',
            ]);
            $rememberCookie->setTranslation('description', 'en', 'This cookie is set when logging in to the app with the "Remember Me" feature enabled. It allows the app to remember you and keep you logged in when you return to the app even when the current session has already expired.');
            $rememberCookie->setTranslation('description', 'de', 'Dieser Cookie wird gesetzt, wenn Sie sich in der App mit der Funktion "Angemeldet bleiben" anmelden. Er ermöglicht es der App, sich an Sie zu erinnern und Sie angemeldet zu halten, wenn Sie zur App zurückkehren, auch wenn die aktuelle Sitzung bereits abgelaufen ist.');
            $rememberCookie->setTranslation('description', 'fr', 'Ce cookie est défini lors de la connexion à l\'application avec la fonction "Se souvenir de moi" activée. Il permet à l\'application de vous rappeler et de vous maintenir connecté lorsque vous revenez à l\'application, même lorsque la session actuelle a déjà expiré.');
            $rememberCookie->setTranslation('description', 'it', 'Questo cookie viene impostato quando si accede all\'app con la funzione "Ricordami" abilitata. Consente all\'app di ricordarti e di mantenerti connesso quando torni all\'app, anche quando la sessione corrente è già scaduta.');
            $rememberCookie->setTranslation('description', 'nl', 'Deze cookie wordt ingesteld wanneer u inlogt op de app met de functie "Onthoud mij" ingeschakeld. Hiermee kan de app u onthouden en ingelogd houden wanneer u terugkeert naar de app, zelfs wanneer de huidige sessie al is verlopen.');
            $rememberCookie->setTranslation('description', 'es', 'Esta cookie se establece al iniciar sesión en la aplicación con la función "Recordarme" habilitada. Permite que la aplicación lo recuerde y lo mantenga conectado cuando regrese a la aplicación, incluso cuando la sesión actual ya haya expirado.');
            $rememberCookie->save();

            $themeCookie = new ServiceCookie([
                'service_definition_id' => $coreService->id,
                'type' => CookieType::LOCAL_STORAGE,
                'name' => 'theme',
                'host' => null,
                'duration' => 'indefinite',
                'legal_basis' => 'legitimate_interest',
            ]);
            $themeCookie->setTranslation('description', 'en', 'This cookie is used to store your choice of light or dark mode for the app if you do not want to use your system default.');
            $themeCookie->setTranslation('description', 'de', 'Dieser Cookie wird verwendet, um Ihre Wahl des hellen oder dunklen Modus für die App zu speichern, wenn Sie nicht Ihren Systemstandard verwenden möchten.');
            $themeCookie->setTranslation('description', 'fr', 'Ce cookie est utilisé pour stocker votre choix du mode clair ou sombre pour l\'application si vous ne souhaitez pas utiliser votre paramètre par défaut du système.');
            $themeCookie->setTranslation('description', 'it', 'Questo cookie viene utilizzato per memorizzare la tua scelta della modalità chiara o scura per l\'app se non vuoi utilizzare il tuo sistema predefinito.');
            $themeCookie->setTranslation('description', 'nl', 'Deze cookie wordt gebruikt om uw keuze voor de lichte of donkere modus voor de app op te slaan als u niet uw systeemstandaard wilt gebruiken.');
            $themeCookie->setTranslation('description', 'es', 'Esta cookie se utiliza para almacenar su elección de modo claro u oscuro para la aplicación si no desea utilizar su configuración predeterminada del sistema.');
            $themeCookie->save();

            $filamentCookies = new ServiceCookie([
                'service_definition_id' => $coreService->id,
                'type' => CookieType::LOCAL_STORAGE,
                'name' => 'isOpen,collapsedGroups,tabs-*',
                'host' => null,
                'duration' => 'indefinite',
                'legal_basis' => 'legitimate_interest',
            ]);
            $filamentCookies->setTranslation('description', 'en', 'These cookies are used to store the state of some elements of the user interface on your current device and ensure a consistent experience.');
            $filamentCookies->setTranslation('description', 'de', 'Diese Cookies werden verwendet, um den Zustand einiger Elemente der Benutzeroberfläche auf Ihrem aktuellen Gerät zu speichern und ein konsistentes Erlebnis sicherzustellen.');
            $filamentCookies->setTranslation('description', 'fr', 'Ces cookies sont utilisés pour stocker l\'état de certains éléments de l\'interface utilisateur sur votre appareil actuel et garantir une expérience cohérente.');
            $filamentCookies->setTranslation('description', 'it', 'Questi cookie vengono utilizzati per memorizzare lo stato di alcuni elementi dell\'interfaccia utente sul dispositivo attuale e garantire un\'esperienza coerente.');
            $filamentCookies->setTranslation('description', 'nl', 'Deze cookies worden gebruikt om de status van sommige elementen van de gebruikersinterface op uw huidige apparaat op te slaan en een consistente ervaring te garanderen.');
            $filamentCookies->setTranslation('description', 'es', 'Estas cookies se utilizan para almacenar el estado de algunos elementos de la interfaz de usuario en su dispositivo actual y garantizar una experiencia coherente.');
            $filamentCookies->save();
        }

        if (!array_key_exists('youtube', $settings->service_ids)) {
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
                'category' => Category::FUNCTIONAL,
                'service_provider_id' => $youTubeProvider->id,
            ]);
            $youTubeService->setTranslation('name', 'en', 'YouTube');
            $youTubeService->setTranslation('description', 'en', "YouTube embeds allow displaying YouTube videos directly in the app without the need to click a link to visit the external YouTube website by using YouTube embeds.\n\nYouTube embeds track user interactions, such as playbacks and preferences, to enhance the viewing experience and maintain user sessions. They also enable YouTube to collect data for analytics, personalized ads, and content recommendations.\n\nWhen a YouTube embed is loaded, Google processes personal data, including the user's IP address, device information, browsing history, and interaction data (e.g., video views and clicks). This data is used to personalize content and ads, perform analytics, and ensure the proper functioning of YouTube services. As a result, users may be tracked across websites, contributing to Google's broader data collection for its advertising network.");
            $youTubeService->setTranslation('description', 'de', "Mithilfe von YouTube-Embeds können YouTube-Videos direkt in der App angezeigt werden, ohne dass auf einen Link geklickt werden muss, um die externe YouTube-Website zu besuchen.\n\nYouTube-Embeds verfolgen Nutzerinteraktionen, wie Wiedergaben und Einstellungen, um die Benutzererfahrung zu verbessern und Nutzersitzungen aufrechtzuerhalten. Sie ermöglichen es YouTube auch, Daten für Analysen, personalisierte Werbung und Inhaltsvorschläge zu sammeln.\n\nWenn ein YouTube-Embed geladen wird, verarbeitet Google persönliche Daten, einschließlich der IP-Adresse des Nutzers, Geräteinformationen, Browserverlauf und Interaktionsdaten (z.B. Videoaufrufe und Klicks). Diese Daten werden genutzt, um Inhalte und Werbung zu personalisieren, Analysen durchzuführen und den ordnungsgemäßen Betrieb der YouTube-Dienste sicherzustellen. Dadurch können Nutzer über Websites hinweg verfolgt werden, was zur breiteren Datenerfassung von Google für sein Werbenetzwerk beiträgt.");
            $youTubeService->setTranslation('description', 'fr', "YouTube permet d'afficher des vidéos YouTube directement dans l'application sans avoir à cliquer sur un lien pour visiter le site Web externe de YouTube en utilisant des intégrations YouTube.\n\nLes intégrations YouTube suivent les interactions des utilisateurs, telles que les lectures et les préférences, pour améliorer l'expérience de visionnage et maintenir les sessions utilisateur. Elles permettent également à YouTube de collecter des données à des fins d'analyse, de publicités personnalisées et de recommandations de contenu.\n\nLorsqu'une intégration YouTube est chargée, Google traite des données personnelles, notamment l'adresse IP de l'utilisateur, les informations sur l'appareil, l'historique de navigation et les données d'interaction (par exemple, les vues et les clics sur les vidéos). Ces données sont utilisées pour personnaliser le contenu et les publicités, effectuer des analyses et assurer le bon fonctionnement des services YouTube. Par conséquent, les utilisateurs peuvent être suivis sur plusieurs sites Web, contribuant ainsi à la collecte de données plus large de Google pour son réseau publicitaire.");
            $youTubeService->setTranslation('description', 'it', "YouTube consente di visualizzare i video di YouTube direttamente nell'app senza la necessità di fare clic su un link per visitare il sito web esterno di YouTube utilizzando le incorporazioni di YouTube.\n\nLe incorporazioni di YouTube tracciano le interazioni degli utenti, come le riproduzioni e le preferenze, per migliorare l'esperienza di visualizzazione e mantenere le sessioni degli utenti. Inoltre, permettono a YouTube di raccogliere dati per analisi, annunci personalizzati e raccomandazioni di contenuti.\n\nQuando viene caricata un'incorporazione di YouTube, Google elabora i dati personali, inclusi l'indirizzo IP dell'utente, le informazioni sul dispositivo, la cronologia di navigazione e i dati di interazione (ad esempio, visualizzazioni di video e clic). Questi dati vengono utilizzati per personalizzare i contenuti e gli annunci, effettuare analisi e garantire il corretto funzionamento dei servizi di YouTube. Di conseguenza, gli utenti possono essere tracciati su diversi siti web, contribuendo alla raccolta più ampia di dati da parte di Google per la sua rete pubblicitaria.");
            $youTubeService->save();

            ServiceCookie::factory()->forEachSequence(...Arr::map([
                [CookieType::COOKIE, 'SIDCC', '.google.com', ['years', 1]],
                [CookieType::COOKIE, 'NID', '.google.com', ['months', 6]],
                [CookieType::COOKIE, 'YSC', '.youtube.com', 'session'],
                [CookieType::COOKIE, 'VISITOR_INFO1_LIVE', '.youtube.com', ['months', 6]],
                [CookieType::COOKIE, 'PREF', '.youtube.com', ['years', 1]],
                [CookieType::COOKIE, 'LOGIN_INFO', '.youtube.com', ['months', 13]],
                [CookieType::COOKIE, 'CONSENT', '.youtube.com', ['months', 9]],
                [CookieType::COOKIE, 'CONSENT', '.google.com', ['months', 9]],
                [CookieType::COOKIE, '__Secure-3PAPISID', '.google.com', ['months', 13]],
                [CookieType::COOKIE, 'SAPISID', '.google.com', ['months', 13]],
                [CookieType::COOKIE, 'APISID', '.google.com', ['months', 13]],
                [CookieType::COOKIE, 'HSID', '.google.com', ['months', 13]],
                [CookieType::COOKIE, '__Secure-3PSID', '.google.com', ['months', 13]],
                [CookieType::COOKIE, '__Secure-3PAPISID', '.youtube.com', ['months', 13]],
                [CookieType::COOKIE, 'SAPISID', '.youtube.com', ['months', 13]],
                [CookieType::COOKIE, 'HSID', '.youtube.com', ['months', 13]],
                [CookieType::COOKIE, 'SSID', '.google.com', ['months', 13]],
                [CookieType::COOKIE, 'SID', '.google.com', ['months', 13]],
                [CookieType::COOKIE, 'SSID', '.youtube.com', ['months', 13]],
                [CookieType::COOKIE, 'APISID', '.youtube.com', ['months', 13]],
                [CookieType::COOKIE, '__Secure-3PSID', '.youtube.com', ['months', 13]],
                [CookieType::COOKIE, 'SID', '.youtube.com', ['months', 13]],
                [CookieType::COOKIE, 'OTZ', 'www.google.com', ['days', 1]],
                [CookieType::COOKIE, 'IDE', '.doubleclick.net', ['months', 9]],
                [CookieType::COOKIE, 'SOCS', '.youtube.com', ['months', 9]],
                [CookieType::COOKIE, 'SOCS', '.google.com', ['months', 9]],
                [CookieType::LOCAL_STORAGE, 'yt-remote-device-id', 'https://www.youtube.com', 'indefinite'],
                [CookieType::LOCAL_STORAGE, 'yt-player-headers-readable', 'https://www.youtube.com', 'indefinite'],
                [CookieType::LOCAL_STORAGE, 'ytidb::LAST_RESULT_ENTRY_KEY', 'https://www.youtube.com', 'indefinite'],
                [CookieType::LOCAL_STORAGE, 'yt-fullerscreen-edu-button-shown-count', 'https://www.youtube.com', 'indefinite'],
                [CookieType::LOCAL_STORAGE, 'yt-remote-connected-devices', 'https://www.youtube.com', 'indefinite'],
                [CookieType::LOCAL_STORAGE, 'yt-player-bandwidth', 'https://www.youtube.com', 'indefinite'],
                [CookieType::INDEXED_DB, 'LogsDatabaseV2:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::INDEXED_DB, 'ServiceWorkerLogsDatabase', 'https://www.youtube.com', 'indefinite'],
                [CookieType::INDEXED_DB, 'YtldbMeta', 'https://www.youtube.com', 'indefinite'],
                [CookieType::COOKIE, '__Secure-YEC', '.youtube.com', ['years', 1]],
                [CookieType::COOKIE, 'test_cookie', '.doubleclick.net', ['days', 1]],
                [CookieType::LOCAL_STORAGE, 'yt-player-quality', 'https://www.youtube.com', 'indefinite'],
                [CookieType::LOCAL_STORAGE, 'yt-player-performance-cap', 'https://www.youtube.com', 'indefinite'],
                [CookieType::LOCAL_STORAGE, 'yt-player-volume', 'https://www.youtube.com', 'indefinite'],
                [CookieType::INDEXED_DB, 'PersistentEntityStoreDb:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::INDEXED_DB, 'yt-idb-pref-storage:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::LOCAL_STORAGE, 'yt.innertube::nextId', 'https://www.youtube.com', 'indefinite'],
                [CookieType::LOCAL_STORAGE, 'yt.innertube::requests', 'https://www.youtube.com', 'indefinite'],
                [CookieType::LOCAL_STORAGE, 'yt-html5-player-modules::subtitlesModuleData::module-enabled', 'https://www.youtube.com', 'indefinite'],
                [CookieType::SESSION_STORAGE, 'yt-remote-session-app', 'https://www.youtube.com', 'session'],
                [CookieType::SESSION_STORAGE, 'yt-remote-cast-installed', 'https://www.youtube.com', 'session'],
                [CookieType::SESSION_STORAGE, 'yt-player-volume', 'https://www.youtube.com', 'session'],
                [CookieType::SESSION_STORAGE, 'yt-remote-session-name', 'https://www.youtube.com', 'session'],
                [CookieType::SESSION_STORAGE, 'yt-remote-cast-available', 'https://www.youtube.com', 'session'],
                [CookieType::SESSION_STORAGE, 'yt-remote-fast-check-period', 'https://www.youtube.com', 'session'],
                [CookieType::LOCAL_STORAGE, '*||::yt-player::yt-player-lv', 'https://www.youtube.com', 'indefinite'],
                [CookieType::INDEXED_DB, 'swpushnotificationsdb', 'https://www.youtube.com', 'indefinite'],
                [CookieType::INDEXED_DB, 'yt-player-local-media:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::INDEXED_DB, 'yt-it-response-store:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::COOKIE, '__HOST-GAPS', 'accounts.google.com', ['months', 13]],
                [CookieType::COOKIE, 'OTZ', 'accounts.google.com', ['days', 1]],
                [CookieType::COOKIE, '__Secure-1PSIDCC', '.google.com', ['years', 1]],
                [CookieType::COOKIE, '__Secure-1PAPISID', '.google.com', ['years', 1]],
                [CookieType::COOKIE, '__Secure-3PSIDCC', '.youtube.com', ['years', 1]],
                [CookieType::COOKIE, '__Secure-1PAPISID', '.youtube.com', ['months', 13]],
                [CookieType::COOKIE, '__Secure-1PSID', '.youtube.com', ['months', 13]],
                [CookieType::COOKIE, '__Secure-3PSIDCC', '.google.com', ['years', 1]],
                [CookieType::COOKIE, '__Secure-ENID', '.google.com', ['years', 1]],
                [CookieType::COOKIE, 'AEC', '.google.com', ['months', 6]],
                [CookieType::COOKIE, '__Secure-1PSID', '.google.com', ['months', 13]],
                [CookieType::INDEXED_DB, 'ytGefConfig:*||', 'https://www.youtube.com', 'indefinite'],
                [CookieType::COOKIE, '__Host-3PLSID', 'accounts.google.com', ['months', 13]],
                [CookieType::COOKIE, 'LSID', 'accounts.google.com', ['months', 13]],
                [CookieType::COOKIE, 'ACCOUNT_CHOOSER', 'accounts.google.com', ['months', 13]],
                [CookieType::COOKIE, '__Host-1PLSID', 'accounts.google.com', ['months', 13]]
            ], fn($values) => [
                ...array_combine(['type', 'name', 'host', 'duration'], $values),
                'description' => [],
                'service_definition_id' => $youTubeService->id,
            ]))->create();

            $settings->service_ids['youtube'] = $youTubeService->id;
            $modified = true;
        }

        if ($modified) {
            $settings->save();
        }
    }
}
