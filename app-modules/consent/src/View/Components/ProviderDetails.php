<?php

namespace FossHaas\Consent\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class ProviderDetails extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    static function formatPhone(string $phone): string
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $parsed = $phoneUtil->parse($phone);
        return $phoneUtil->format($parsed, PhoneNumberFormat::INTERNATIONAL);
    }

    static function url(string $url): string
    {
        if (str_starts_with($url, '/')) {
            return url($url);
        }
        return $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('consent::components.provider-details', [
            'formatPhone' => fn (string $phone) => $this::formatPhone($phone),
            'url' => fn (string $url) => $this::url($url),
        ]);
    }
}
