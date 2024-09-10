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
      self::CONSENT => __('DSGVO Art. 6 Abs. 1 lit. a'),
      self::CONTRACT => __('DSGVO Art. 6 Abs. 1 lit. b'),
      self::LEGAL_OBLIGATION => __('DSGVO Art. 6 Abs. 1 lit. c'),
      self::VITAL_INTEREST => __('DSGVO Art. 6 Abs. 1 lit. d'),
      self::PUBLIC_INTEREST => __('DSGVO Art. 6 Abs. 1 lit. e'),
      self::LEGITIMATE_INTEREST => __('DSGVO Art. 6 Abs. 1 lit. f'),
    };
  }

  public function description(): string
  {
    return match ($this) {
      self::CONSENT => __('Einwilligung'),
      self::CONTRACT => __('Erfüllung eines Vertrags'),
      self::LEGAL_OBLIGATION => __('Rechtliche Verpflichtung'),
      self::VITAL_INTEREST => __('Lebenswichtige Interessen'),
      self::PUBLIC_INTEREST => __('Öffentliches Interesse'),
      self::LEGITIMATE_INTEREST => __('Berechtiges Interesse'),
    };
  }
}
