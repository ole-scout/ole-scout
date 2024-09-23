<?php

namespace FossHaas\Support;

use Carbon\CarbonInterval;
use Illuminate\Support\Arr;

class Duration
{

  public static function format(string|array $duration): string
  {
    if (is_array($duration)) {
      [$unit, $value] = $duration;
      $interval = CarbonInterval::$unit($value);
      return $interval->forHumans([
        'skip' => array_keys(Arr::except($interval->toArray(), $unit))
      ]);
    }
    return match ($duration) {
      'session' => __('Session'),
      'indefinite' => __('indefinite'),
      default => (string) $duration,
    };
  }
}
