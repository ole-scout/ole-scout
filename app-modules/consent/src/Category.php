<?php

namespace FossUndHaas\Consent;

use Illuminate\Support\Arr;

enum Category
{
  case essential;
  case functional;
  case analytics;
  case marketing;
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
