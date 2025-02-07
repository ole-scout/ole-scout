<?php

namespace FossHaas\Lrs\DataTransferObjects\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class ListOrItemCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context, CreationContext $creationContext): mixed
    {

        if (isset($value) && (! is_array($value) || ! array_is_list($value))) {

            $value = [$value];
        }

        $type = $property->type->dataClass;

        return array_map(fn ($item) => $type::from($item), $value);
    }
}
