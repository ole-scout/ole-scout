<?php

namespace FossHaas\Lrs\Rules;

use FossHaas\Validation\ArrayValidationRule;
use FossHaas\Validation\Rules\RecordOf;

class InteractionComponent extends ArrayValidationRule
{
    public function __construct()
    {
        $this->rules = [
            'id' => ['string', 'distinct'],
            'description' => ['sometimes', ...new RecordOf(new LanguageTagRule)],
            'description.*' => ['required_with:description', 'string'],
        ];
    }
}
