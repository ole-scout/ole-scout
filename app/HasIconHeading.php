<?php

namespace App;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

trait HasIconHeading
{
    public function getTitle(): string
    {
        return static::getNavigationLabel();
    }

    public function getHeading(): string | Htmlable
    {
        $icon = static::getNavigationIcon();
        $title = $this->getTitle();
        return new HtmlString(
            view('components.filament.icon-heading', [
                'icon' => $icon,
                'title' => $title,
            ])
        );
    }
}
