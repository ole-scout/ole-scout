<?php

namespace FossHaas\Validation;

use Illuminate\Contracts\Validation\ValidationRule;

abstract class IterableValidationRule implements \IteratorAggregate, ValidationRule
{
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator([$this]);
    }
}
