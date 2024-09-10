<?php

namespace FossHaas\Courses\Enums;

use Illuminate\Support\Arr;

enum Access: string
{
    case HIDDEN = 'hidden';
    case VISIBLE = 'visible';
    case OPEN = 'open';

    public static function values(): array
    {
        return Arr::map(self::cases(), fn(Access $case) => $case->value);
    }

    public function label(): string
    {
        return match ($this) {
            self::HIDDEN => __('Verborgen'),
            self::VISIBLE => __('Sichtbar'),
            self::OPEN => __('Freie Teilnahme'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::HIDDEN => __('Der Kurs ist nur mit Zuweisung sichtbar.'),
            self::VISIBLE => __('Die Teilnahme erfordert eine Zuweisung.'),
            self::OPEN => __('Die Teilnahme ist ohne Zuweisung möglich.'),
        };
    }
}
