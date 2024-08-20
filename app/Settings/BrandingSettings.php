<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class BrandingSettings extends Settings
{
  public string $name;
  public string $color;
  public ?string $logo;

  public static function group(): string
  {
    return 'branding';
  }
}
