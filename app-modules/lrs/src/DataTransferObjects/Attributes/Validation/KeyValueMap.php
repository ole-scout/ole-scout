<?php

namespace FossHaas\Lrs\DataTransferObjects\Attributes\Validation;

use Attribute;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;
use Spatie\LaravelData\Attributes\Validation\ObjectValidationAttribute;
use Spatie\LaravelData\Support\Validation\RequiringRule;
use Spatie\LaravelData\Support\Validation\ValidationPath;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
class KeyValueMap extends ObjectValidationAttribute implements RequiringRule, ValidationRule
{
    protected array $keyRules = [];

    protected array $valueRules = [];

    public function __construct(
        mixed $keyRules = [],
        mixed $valueRules = []
    ) {
        $this->keyRules = is_array($keyRules) ? $keyRules : [$keyRules];
        $this->valueRules = is_array($valueRules) ? $valueRules : [$valueRules];
    }

    public function getRule(ValidationPath $path): object|string
    {
        return $this;
    }

    public static function keyword(): string
    {
        return 'kvm';
    }

    public static function create(string ...$parameters): static
    {
        return new static;
    }

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $validator = Validator::make(['keys' => array_keys($value), 'values' => array_values($value)], [
            'keys.*' => $this->keyRules,
            'values.*' => $this->valueRules,
        ]);

        if ($validator->fails()) {
            $fail($validator->errors()->first());
        }
    }
}
