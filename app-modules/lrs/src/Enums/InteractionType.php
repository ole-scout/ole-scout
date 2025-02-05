<?php

namespace FossHaas\Lrs\Enums;

use Illuminate\Support\Arr;

enum InteractionType: string
{
    case TRUE_FALSE = 'true-false';
    case CHOICE = 'choice';
    case FILL_IN = 'fill-in';
    case LONG_FILL_IN = 'long-fill-in';
    case MATCHING = 'matching';
    case PERFORMANCE = 'performance';
    case SEQUENCING = 'sequencing';
    case LIKERT = 'likert';
    case NUMERIC = 'numeric';
    case OTHER = 'other';

    public static function values(): array
    {
        return Arr::map(self::cases(), fn (InteractionType $case) => $case->value);
    }
}
