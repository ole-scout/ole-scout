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
        return Arr::map(self::cases(), fn (Access $case) => $case->value);
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::HIDDEN => __('Hidden'),
            self::VISIBLE => __('Visible'),
            self::OPEN => __('Open Access'),
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::HIDDEN => __('This course is only visible to enrolled users.'),
            self::VISIBLE => __('This course is visible to all users but can only be accessed by enrolled users.'),
            self::OPEN => __('This course is visible to all users and can be accessed by all users.'),
        };
    }
}
