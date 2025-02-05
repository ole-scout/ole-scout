<?php

namespace FossHaas\Lrs\Rules;

use FossHaas\Validation\ArrayValidationRule;

class Activity extends ArrayValidationRule
{
    public function __construct()
    {
        $this->rules = [
            'objectType' => ['string', 'in:Activity'],
            'id' => ['required', 'string', 'url'],
            'definition' => ['sometimes', ...new ActivityDefinition],
        ];
    }
}
