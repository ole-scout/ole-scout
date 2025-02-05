<?php

namespace FossHaas\Lrs\Enums;

use Illuminate\Support\Arr;

enum XapiActivityRelationship: string
{
    case OBJECT = 'object';
    case PARENT = 'parent';
    case GROUPING = 'grouping';
    case CATEGORY = 'category';
    case OTHER = 'other';
    case SUB_OBJECT = 'sub_object';
    case SUB_PARENT = 'sub_parent';
    case SUB_GROUPING = 'sub_grouping';
    case SUB_CATEGORY = 'sub_category';
    case SUB_OTHER = 'sub_other';

    public static function values(): array
    {
        return Arr::map(self::cases(), fn (XapiActivityRelationship $case) => $case->value);
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::OBJECT => __('Object'),
            self::PARENT => __('Parent Activity'),
            self::GROUPING => __('Grouping Activity'),
            self::CATEGORY => __('Category Activity'),
            self::OTHER => __('Other Context Activity'),
            self::SUB_OBJECT => __('Object of SubStatement'),
            self::SUB_PARENT => __('Parent Activity of SubStatement'),
            self::SUB_GROUPING => __('Grouping Activity of SubStatement'),
            self::SUB_CATEGORY => __('Category Activity of SubStatement'),
            self::SUB_OTHER => __('Other Context Activity of SubStatement'),
        };
    }
}
