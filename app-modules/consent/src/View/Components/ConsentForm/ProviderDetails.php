<?php

namespace FossHaas\Consent\View\Components\ConsentForm;

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

    public function url($url): string
    {
        if (substr($url, 0, 1) === '/') {
            return url($url);
        }
        return $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('consent::components.consent-form.provider-details');
    }
}
