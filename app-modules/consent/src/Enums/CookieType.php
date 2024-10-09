<?php

namespace FossHaas\Consent\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Arr;

enum CookieType: string implements HasLabel
{
  case COOKIE = 'cookie';
  case LOCAL_STORAGE = 'local_storage';
  case SESSION_STORAGE = 'session_storage';
  case INDEXED_DB = 'indexed_db';

  public static function values(): array
  {
    return Arr::map(self::cases(), fn(CookieType $case) => $case->value);
  }

  public function getLabel(): string
  {
    return match ($this) {
      self::COOKIE => __('Cookie'),
      self::LOCAL_STORAGE => __('Local Storage'),
      self::SESSION_STORAGE => __('Session Storage'),
      self::INDEXED_DB => __('IndexedDB'),
    };
  }
}
