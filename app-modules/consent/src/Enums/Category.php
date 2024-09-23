<?php

namespace FossHaas\Consent\Enums;

use Illuminate\Support\Arr;

enum Category: string
{
  case ESSENTIAL = 'essential';
  case FUNCTIONAL = 'functional';
  case ANALYTICS = 'analytics';
  case MARKETING = 'marketing';

  public static function values(): array
  {
    return Arr::map(self::cases(), fn(Category $case) => $case->value);
  }

  public function label(): string
  {
    return match ($this) {
      self::ESSENTIAL => __('Essential'),
      self::FUNCTIONAL => __('Functional'),
      self::ANALYTICS => __('Analytics'),
      self::MARKETING => __('Marketing'),
    };
  }
}
