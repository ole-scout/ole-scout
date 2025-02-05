<?php

namespace FossHaas\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class MatchArray implements \IteratorAggregate, DataAwareRule, ValidationRule
{
    protected array $data = [];

    public function __construct(
        protected string $key,
        /** @var array<string,list|Closure> */
        protected array $rulesMap,
        protected ?string $defaultKey = null,
    ) {
        if ($this->defaultKey && ! isset($this->rulesMap[$this->defaultKey])) {
            throw new \Exception('Default key must be in rules map');
        }
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator(['array', $this]);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $attributeRules = ['array'];
        $check = $value[$this->key] ?? $this->defaultKey;
        if (isset($this->rulesMap[$check])) {
            $rules = $this->rulesMap[$check];
            array_push($attributeRules, ...$rules instanceof Closure ? $rules($value) : $rules);
        }

        $keys = implode(',', array_keys($this->rulesMap));
        $validator = Validator::make($this->data, [
            $attribute => $attributeRules,
            "{$attribute}.{$this->key}" => [$this->defaultKey ? 'sometimes' : 'required', "in:$keys"],
        ]);

        if ($validator->fails()) {
            $fail($validator->errors()->first());
        }
    }
}
