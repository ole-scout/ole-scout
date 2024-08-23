<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class BrandingSettings extends Settings
{
  public string $name;
  public ?string $logo;
  public string $brandColor;
  public string $primaryColor;

  public static function group(): string
  {
    return 'branding';
  }
}
