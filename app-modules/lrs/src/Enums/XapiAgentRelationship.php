<?php

namespace FossHaas\Lrs\Enums;

use Illuminate\Support\Arr;

enum XapiAgentRelationship: string
{
    case ACTOR = 'actor';
    case OBJECT = 'object';
    case CONTEXT = 'context';
    case INSTRUCTOR = 'instructor';
    case ACTOR_MEMBER = 'actor_member';
    case OBJECT_MEMBER = 'object_member';
    case CONTEXT_MEMBER = 'context_member';
    case INSTRUCTOR_MEMBER = 'instructor_member';
    case TEAM_MEMBER = 'team_member';
    case SUB_ACTOR = 'sub_actor';
    case SUB_OBJECT = 'sub_object';
    case SUB_CONTEXT = 'sub_context';
    case SUB_INSTRUCTOR = 'sub_instructor';
    case SUB_ACTOR_MEMBER = 'sub_actor_member';
    case SUB_OBJECT_MEMBER = 'sub_object_member';
    case SUB_CONTEXT_MEMBER = 'sub_context_member';
    case SUB_INSTRUCTOR_MEMBER = 'sub_instructor_member';
    case SUB_TEAM_MEMBER = 'sub_team_member';

    public static function member(XapiGroupRelationship $relationship): XapiAgentRelationship
    {
        return match ($relationship) {
            XapiGroupRelationship::ACTOR => self::ACTOR_MEMBER,
            XapiGroupRelationship::OBJECT => self::OBJECT_MEMBER,
            XapiGroupRelationship::CONTEXT => self::CONTEXT_MEMBER,
            XapiGroupRelationship::INSTRUCTOR => self::INSTRUCTOR_MEMBER,
            XapiGroupRelationship::TEAM => self::TEAM_MEMBER,
            XapiGroupRelationship::SUB_ACTOR => self::SUB_ACTOR_MEMBER,
            XapiGroupRelationship::SUB_OBJECT => self::SUB_OBJECT_MEMBER,
            XapiGroupRelationship::SUB_CONTEXT => self::SUB_CONTEXT_MEMBER,
            XapiGroupRelationship::SUB_INSTRUCTOR => self::SUB_INSTRUCTOR_MEMBER,
            XapiGroupRelationship::SUB_TEAM => self::SUB_TEAM_MEMBER,
        };
    }

    public static function values(): array
    {
        return Arr::map(self::cases(), fn (XapiAgentRelationship $case) => $case->value);
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::ACTOR => __('Actor'),
            self::OBJECT => __('Object'),
            self::INSTRUCTOR => __('Instructor'),
            self::CONTEXT => __('Context Agent'),
            self::ACTOR_MEMBER => __('Member of Actor'),
            self::OBJECT_MEMBER => __('Member of Object'),
            self::CONTEXT_MEMBER => __('Member of Context'),
            self::INSTRUCTOR_MEMBER => __('Member of Instructor'),
            self::TEAM_MEMBER => __('Member of Team'),
            self::SUB_ACTOR => __('Actor of SubStatement'),
            self::SUB_OBJECT => __('Object of SubStatement'),
            self::SUB_CONTEXT => __('Context Agent of SubStatement'),
            self::SUB_INSTRUCTOR => __('Instructor of SubStatement'),
            self::SUB_ACTOR_MEMBER => __('Member of Actor of SubStatement'),
            self::SUB_OBJECT_MEMBER => __('Member of Object of SubStatement'),
            self::SUB_CONTEXT_MEMBER => __('Member of Context of SubStatement'),
            self::SUB_INSTRUCTOR_MEMBER => __('Member of Instructor of SubStatement'),
            self::SUB_TEAM_MEMBER => __('Member of Team of SubStatement'),
        };
    }
}
