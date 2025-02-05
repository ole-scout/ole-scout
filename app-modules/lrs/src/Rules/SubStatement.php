<?php

namespace FossHaas\Lrs\Rules;

use FossHaas\Validation\ArrayValidationRule;
use FossHaas\Validation\Rules\MatchArray;
use FossHaas\Validation\Rules\RecordOf;

class SubStatement extends ArrayValidationRule
{
    public function __construct()
    {
        $this->rules = [
            'objectType' => ['required', 'string', 'in:SubStatement'],
            'actor' => ['required', ...new MatchArray('objectType', [
                'Agent' => fn () => [...new Agent],
                'Group' => fn () => [...new Group],
            ], 'Agent')],
            'verb' => ['required', 'array'],
            'verb.id' => ['required', 'string', 'url'],
            'verb.display' => ['sometimes', ...new RecordOf(new LanguageTagRule)],
            'verb.display.*' => ['required_with:verb.display', 'string'],
            'object' => ['required', ...new MatchArray('objectType', [
                'Activity' => fn () => [...new Activity],
                'Agent' => fn () => [...new Agent],
                'Group' => fn () => [...new Group],
                'StatementRef' => fn () => [...new StatementRef],
                'SubStatement' => fn () => [...new SubStatement],
            ], 'Activity')],
            'result' => ['sometimes', ...new Result],
            'context' => ['sometimes', ...new Context],
            'timestamp' => ['string'],
            'attachments' => ['array'],
            'attachments.*' => ['sometimes', 'required_with:attachments', ...new Attachment],
        ];
    }
}
