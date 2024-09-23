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
            self::HIDDEN => __('Hidden'),
            self::VISIBLE => __('Visible'),
            self::OPEN => __('Open participation'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::HIDDEN => __('This course is only visible to enrolled users.'),
            self::VISIBLE => __('Participation requires enrollment.'),
            self::OPEN => __('Participation does not require enrollment.'),
        };
    }
}
