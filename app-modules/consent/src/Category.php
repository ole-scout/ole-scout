<?php

namespace FossHaas\Consent;

use Illuminate\Support\Arr;

enum Category: string
{
  case essential = 'essential';
  case functional = 'functional';
  case analytics = 'analytics';
  case marketing = 'marketing';
  public static function names(): array
  {
    return Arr::map(
      self::cases(),
      fn (Category $category) => $category->name
    );
  }
  public function label(): string
  {
    return match ($this) {
      self::essential => __('Essenziell'),
      self::functional => __('Funktional'),
      self::analytics => __('Statistik'),
      self::marketing => __('Marketing'),
    };
  }
}
