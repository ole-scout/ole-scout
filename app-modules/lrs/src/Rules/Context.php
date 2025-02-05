<?php

namespace FossHaas\Lrs\Rules;

use FossHaas\Validation\ArrayValidationRule;
use FossHaas\Validation\Rules\ArrayRule;
use FossHaas\Validation\Rules\ListOf;
use FossHaas\Validation\Rules\ListOrItem;
use FossHaas\Validation\Rules\MatchArray;
use FossHaas\Validation\Rules\RecordOf;

class Context extends ArrayValidationRule
{
    public function __construct()
    {
        $this->rules = [
            'registration' => ['string', 'uuid'],
            'instructor' => ['sometimes', ...new MatchArray('objectType', [
                'Agent' => fn () => [...new Agent],
                'Group' => fn () => [...new Group],
            ], 'Agent')],
            'team' => ['sometimes', ...new Group],
            'contextActivities' => ['sometimes', ...new ArrayRule([
                'parent' => ['sometimes', ...new ListOrItem(...new Activity)],
                'grouping' => ['sometimes', ...new ListOrItem(...new Activity)],
                'category' => ['sometimes', ...new ListOrItem(...new Activity)],
                'other' => ['sometimes', ...new ListOrItem(...new Activity)],
            ])],
            'contextAgents' => ['sometimes', new ListOf(...new ArrayRule([
                'objectType' => ['required', 'string', 'in:contextAgent'],
                'agent' => ['required', ...new Agent],
                'relevantTypes' => ['sometimes', ...new ListOf('required', 'string', 'url')],
            ]))],
            'contextGroups' => ['sometimes', new ListOf(...new ArrayRule([
                'objectType' => ['required', 'string', 'in:contextGroup'],
                'group' => ['required', ...new Group],
                'relevantTypes' => ['sometimes', ...new ListOf('required', 'string', 'url')],
            ]))],
            'revision' => ['string'],
            'platform' => ['string'],
            'language' => ['string'],
            'statement' => ['sometimes', ...new StatementRef],
            'extensions' => ['sometimes', ...new RecordOf('string', 'url')],
        ];
    }
}
