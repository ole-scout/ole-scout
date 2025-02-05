<?php

namespace FossHaas\Lrs\Rules;

use FossHaas\Validation\ArrayValidationRule;

class StatementRef extends ArrayValidationRule
{
    public function __construct()
    {
        $this->rules = [
            'objectType' => ['required', 'string', 'in:StatementRef'],
            'id' => ['required', 'string', 'uuid'],
        ];
    }
}
