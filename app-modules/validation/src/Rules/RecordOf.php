<?php

namespace FossHaas\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class RecordOf implements \IteratorAggregate, ValidationRule
{
    protected mixed $keyRules;

    public function __construct(
        mixed ...$keyRules,
    ) {
        $this->keyRules = $keyRules;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator(['array', $this]);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validator = Validator::make(['keys' => array_keys($value)], [
            'keys.*' => $this->keyRules,
        ]);

        if ($validator->fails()) {
            $fail($validator->errors()->first());
        }
    }
}
