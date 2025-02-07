<?php

namespace FossHaas\Lrs\DataTransferObjects\Attributes\Validation;

use Attribute;
use Spatie\LaravelData\Attributes\Validation\ObjectValidationAttribute;
use Spatie\LaravelData\Support\Validation\RequiringRule;
use Spatie\LaravelData\Support\Validation\ValidationPath;

/**
 * RFC 5646 language tag validation rule.
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
class LanguageTag extends ObjectValidationAttribute implements RequiringRule
{
    public function getRule(ValidationPath $path): object|string
    {
        return static::keyword();
    }

    public static function keyword(): string
    {
        $extlang = '[a-z]{3}(?:-[a-z]{3}){0,2}';
        $language = "(?:[a-z]{2,3}(?:-$extlang)?|[a-z]{4}|[a-z]{5,8})";
        $script = '[a-z]{4}';
        $region = '(?:[a-z]{2}|[0-9]{3})';
        $variant = '(?:[a-z0-9]{5,8}|[0-9][a-z0-9]{3})';
        $extension = '[a-wyz0-9](?:-[a-z0-9]{2,8})+';
        $privateuse = 'x(?:-[a-z0-9]{1,8})+';
        $langtag = "$language(?:-$script)?(?:-$region)?(?:-$variant)*(?:-$extension)*(?:-$privateuse)?";
        $irregular = 'en-GB-oed|i-(?:amni|bnn|default|enochian|hak|klingon|lux|mingo|navajo|pwn|tao|tay|tsu)|sgn-(?:BE-FR|BE-NL|CH-DE)';
        $regex = "/^(?:$langtag|$irregular)$/i";

        return "regex:{$regex}";
    }

    public static function create(string ...$parameters): static
    {
        return new static;
    }
}
