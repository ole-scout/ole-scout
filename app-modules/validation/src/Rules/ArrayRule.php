<?php

namespace FossHaas\Validation\Rules;

use FossHaas\Validation\ArrayValidationRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ArrayRule extends ArrayValidationRule implements DataAwareRule
{
    protected array $data = [];

    public function __construct(
        protected array $rules
    ) {}

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $validator = Validator::make($this->data, Arr::mapWithKeys(
            $this->rules,
            fn (array $rules, string $key) => ["{$attribute}.{$key}" => $rules]
        ));

        if ($validator->fails()) {
            $fail($validator->errors()->first());
        }
    }
}
