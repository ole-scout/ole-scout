<?php

namespace FossHaas\Consent;

use Illuminate\Support\Arr;

enum LegalBasis: string
{
  case consent = 'consent';
  case contract = 'contract';
  case legal_obligation = 'legal_obligation';
  case vital_interest = 'vital_interest';
  case public_interest = 'public_interest';
  case legitimate_interest = 'legitimate_interest';

  public static function names(): array
  {
    return Arr::map(self::cases(), fn (LegalBasis $case) => $case->name);
  }

  public function label(): string
  {
    return match ($this) {
      self::consent => __('DSGVO Art. 6 Abs. 1 lit. a'),
      self::contract => __('DSGVO Art. 6 Abs. 1 lit. b'),
      self::legal_obligation => __('DSGVO Art. 6 Abs. 1 lit. c'),
      self::vital_interest => __('DSGVO Art. 6 Abs. 1 lit. d'),
      self::public_interest => __('DSGVO Art. 6 Abs. 1 lit. e'),
      self::legitimate_interest => __('DSGVO Art. 6 Abs. 1 lit. f'),
    };
  }

  public function description(): string
  {
    return match ($this) {
      self::consent => __('Einwilligung'),
      self::contract => __('Erfüllung eines Vertrags'),
      self::legal_obligation => __('Rechtliche Verpflichtung'),
      self::vital_interest => __('Lebenswichtige Interessen'),
      self::public_interest => __('Öffentliches Interesse'),
      self::legitimate_interest => __('Berechtiges Interesse'),
    };
  }
}
