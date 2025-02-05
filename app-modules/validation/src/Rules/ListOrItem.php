<?php

namespace FossHaas\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class ListOrItem implements \IteratorAggregate, DataAwareRule, ValidationRule
{
    protected array $data = [];

    protected mixed $itemRules;

    public function __construct(
        mixed ...$itemRules
    ) {
        $this->itemRules = $itemRules;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator([$this]);
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validator = Validator::make($this->data, array_is_list($value) ? [
            $attribute => ['list'],
            "{$attribute}.*" => $this->itemRules,
        ] : [
            $attribute => $this->itemRules,
        ]);

        if ($validator->fails()) {
            $fail($validator->errors()->first());
        }
    }
}
