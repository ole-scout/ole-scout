<?php

namespace FossHaas\Consent\Settings;

use Spatie\LaravelSettings\Settings;

class AppConsentSettings extends Settings
{
    /** @var array<string,int> */
    public array $service_ids;
    public string $privacy_url;
    public string $consent_url;
    public ?string $imprint_url;

    public static function group(): string
    {
        return 'consent::app';
    }

    public function privacyPolicy(): string
    {
        return $this->privacy_url[0] === '/'
            ? $this->privacy_url
            : url($this->privacy_url);
    }

    public function consent(): string
    {
        return $this->consent_url[0] === '/'
            ? $this->consent_url
            : url($this->consent_url);
    }

    public function imprint(): ?string
    {
        return $this->imprint_url
            ? (
                $this->imprint_url[0] === '/'
                ? $this->imprint_url
                : url($this->imprint_url)
            )
            : null;
    }

    /** @return array<string> */
    public function excludedUrls(): array
    {
        return array_filter([
            $this->privacy_url,
            $this->consent_url,
            $this->imprint_url,
        ]);
    }
}
