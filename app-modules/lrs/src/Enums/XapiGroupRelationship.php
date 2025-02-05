<?php

namespace FossHaas\Lrs\Enums;

use Illuminate\Support\Arr;

enum XapiGroupRelationship: string
{
    case ACTOR = 'actor';
    case OBJECT = 'object';
    case AUTHORITY = 'authority';
    case CONTEXT = 'context';
    case INSTRUCTOR = 'instructor';
    case TEAM = 'team';
    case SUB_ACTOR = 'sub_actor';
    case SUB_OBJECT = 'sub_object';
    case SUB_CONTEXT = 'sub_context';
    case SUB_INSTRUCTOR = 'sub_instructor';
    case SUB_TEAM = 'sub_team';

    public static function values(): array
    {
        return Arr::map(self::cases(), fn (XapiGroupRelationship $case) => $case->value);
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::ACTOR => __('Actor'),
            self::OBJECT => __('Object'),
            self::AUTHORITY => __('Authority'),
            self::CONTEXT => __('Context Group'),
            self::INSTRUCTOR => __('Instructor'),
            self::TEAM => __('Team'),
            self::SUB_ACTOR => __('Actor of SubStatement'),
            self::SUB_OBJECT => __('Object of SubStatement'),
            self::SUB_CONTEXT => __('Context Group of SubStatement'),
            self::SUB_INSTRUCTOR => __('Instructor of SubStatement'),
            self::SUB_TEAM => __('Team of SubStatement'),
        };
    }
}
