<?php

namespace FossHaas\Lrs\DataTransferObjects\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class ObjectTypeCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        $types = array_keys($property->type->getAcceptedTypes());
        $type = $types[0];
        if (isset($value['objectType'])) {
            foreach ($types as $className) {
                if (is_callable([$className, 'getObjectType'])) {
                    $objectType = $className::getObjectType();
                } else {
                    $found = preg_match('/\\\\(?<objectType>\w+)(?:Data)?$/', $className, $matches);
                    if (! $found) {
                        continue;
                    }
                    $objectType = $matches['objectType'];
                }
                if ($objectType !== $value['objectType']) {
                    continue;
                }
                $type = $className;
                break;
            }
        }

        return $type::from($value);
    }
}
