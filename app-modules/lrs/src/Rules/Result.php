<?php

namespace FossHaas\Lrs\Rules;

use FossHaas\Validation\ArrayValidationRule;
use FossHaas\Validation\Rules\RecordOf;

class Result extends ArrayValidationRule
{
    public function __construct()
    {
        $this->rules = [
            'score' => ['array:scaled,raw,min,max'],
            'score.scaled' => ['decimal', 'between:-1,1'],
            'score.raw' => ['decimal'],
            'score.min' => ['decimal'],
            'score.max' => ['decimal'],
            'success' => ['boolean'],
            'completion' => ['boolean'],
            'response' => ['string'],
            'duration' => ['string'], // ISO 8601 Period
            'extensions' => ['sometimes', ...new RecordOf('string', 'url')],
        ];
    }
}
