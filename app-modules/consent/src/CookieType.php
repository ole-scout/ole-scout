<?php

namespace FossHaas\Consent;

enum CookieType: string
{
  case cookie = 'cookie';
  case local_storage = 'local_storage';
  case session_storage = 'session_storage';
  public function label(): string
  {
    return match ($this) {
      self::cookie => __('Cookie'),
      self::local_storage => __('Local Storage'),
      self::session_storage => __('Session Storage'),
    };
  }
}
