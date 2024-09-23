<?php

namespace FossHaas\Consent\Enums;

use Illuminate\Support\Arr;

enum LegalBasis: string
{
  case CONSENT = 'consent';
  case CONTRACT = 'contract';
  case LEGAL_OBLIGATION = 'legal_obligation';
  case VITAL_INTEREST = 'vital_interest';
  case PUBLIC_INTEREST = 'public_interest';
  case LEGITIMATE_INTEREST = 'legitimate_interest';

  public static function values(): array
  {
    return Arr::map(self::cases(), fn(LegalBasis $case) => $case->value);
  }

  public function label(): string
  {
    return match ($this) {
      self::CONSENT => __('GDPR Article 6(1)(a)'),
      self::CONTRACT => __('GDPR Article 6(1)(b)'),
      self::LEGAL_OBLIGATION => __('GDPR Article 6(1)(c)'),
      self::VITAL_INTEREST => __('GDPR Article 6(1)(d)'),
      self::PUBLIC_INTEREST => __('GDPR Article 6(1)(e)'),
      self::LEGITIMATE_INTEREST => __('GDPR Article 6(1)(f)'),
    };
  }

  public function description(): string
  {
    return match ($this) {
      self::CONSENT => __('Consent'),
      self::CONTRACT => __('Performance of a contract'),
      self::LEGAL_OBLIGATION => __('Legal obligation'),
      self::VITAL_INTEREST => __('Vital interest'),
      self::PUBLIC_INTEREST => __('Public interest'),
      self::LEGITIMATE_INTEREST => __('Legitimate interest'),
    };
  }
}
