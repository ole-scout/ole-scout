<?php

namespace FossHaas\Lrs\Rules;

use Closure;
use FossHaas\Validation\ArrayValidationRule;
use FossHaas\Validation\Rules\ListOf;
use FossHaas\Validation\Rules\MatchArray;
use FossHaas\Validation\Rules\RecordOf;
use Illuminate\Support\Facades\Validator;

class Statement extends ArrayValidationRule
{
    public function __construct()
    {
        $this->rules = [
            'id' => ['string', 'uuid'],
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
            'stored' => ['string'], // ISO 8601
            'timestamp' => ['string'], // ISO 8601
            'authority' => ['sometimes', ...new MatchArray('objectType', [
                'Agent' => fn () => [...new Agent],
                'Group' => fn () => [...new Group],
            ], 'Agent')],
            'version' => ['string'],
            'attachments' => ['sometimes', ...new ListOf(...new Attachment)],
        ];
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validator = Validator::make($value, $this->rules);

        $validator->sometimes('object.objectType', 'in:StatementRef', fn ($input) => isset($input->verb['id']) && $input->verb['id'] === 'http://adlnet.gov/expapi/verbs/voided');

        if ($validator->fails()) {
            $fail($validator->errors()->first());
        }
    }
}
