<?php

namespace FossHaas\Lrs\Enums;

use Illuminate\Support\Arr;

enum XapiStatementRelationship: string
{
    case OBJECT = 'object';
    case CONTEXT = 'context';
    case SUB_OBJECT = 'sub_object';
    case SUB_CONTEXT = 'sub_context';

    public static function values(): array
    {
        return Arr::map(self::cases(), fn (XapiStatementRelationship $case) => $case->value);
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::OBJECT => __('Object'),
            self::CONTEXT => __('Context Statement'),
            self::SUB_OBJECT => __('Object of SubStatement'),
            self::SUB_CONTEXT => __('Context Statement of SubStatement'),
        };
    }
}
