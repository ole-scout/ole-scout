<?php

namespace FossHaas\Consent\View\Components\ConsentForm;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CookieDetails extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('consent::components.consent-form.cookie-details');
    }
}
