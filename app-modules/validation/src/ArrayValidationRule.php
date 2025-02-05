<?php

namespace FossHaas\Validation;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

abstract class ArrayValidationRule implements \IteratorAggregate, ValidationRule
{
    protected array $rules;

    public function getIterator(): \Traversable
    {
        $keys = implode(',', array_unique(array_map(
            fn ($key) => explode('.', $key)[0],
            array_keys($this->rules)
        )));

        return new \ArrayIterator(["array:$keys", $this]);
    }

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $validator = Validator::make($value, $this->rules);

        if ($validator->fails()) {
            $fail($validator->errors()->first());
        }
    }
}
