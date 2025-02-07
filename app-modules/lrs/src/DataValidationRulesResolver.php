<?php

namespace FossHaas\Lrs;

use Illuminate\Support\Arr;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Validation\DataRules;
use Spatie\LaravelData\Support\Validation\ValidationPath;

class DataValidationRulesResolver extends \Spatie\LaravelData\Resolvers\DataValidationRulesResolver
{
    protected function resolveDataSpecificRules(
        DataProperty $dataProperty,
        array $fullPayload,
        ValidationPath $path,
        ValidationPath $propertyPath,
        DataRules $dataRules,
    ): void {
        $isOptionalAndEmpty = $dataProperty->type->isOptional && Arr::has($fullPayload, $propertyPath->get()) === false;
        $isNullableAndEmpty = $dataProperty->type->isNullable && Arr::get($fullPayload, $propertyPath->get()) === null;

        if ($isOptionalAndEmpty || $isNullableAndEmpty) {
            $this->resolveToplevelRules(
                $dataProperty,
                $fullPayload,
                $path,
                $propertyPath,
                $dataRules
            );

            return;
        }

        if ($dataProperty->type->kind->isDataObject()) {
            $this->resolveDataObjectSpecificRules(
                $dataProperty,
                $fullPayload,
                $path,
                $propertyPath,
                $dataRules
            );

            return;
        }

        if ($dataProperty->type->kind->isDataCollectable()) {
            if ($dataProperty->cast instanceof DataTransferObjects\Casts\ListOrItemCast) {
                $value = Arr::get($fullPayload, $propertyPath->get());
                if (isset($value) && (! is_array($value) || ! array_is_list($value))) {
                    $this->resolveDataObjectSpecificRules(
                        $dataProperty,
                        $fullPayload,
                        $path,
                        $propertyPath,
                        $dataRules
                    );

                    return;
                }
            }
            $this->resolveDataCollectionSpecificRules(
                $dataProperty,
                $fullPayload,
                $path,
                $propertyPath,
                $dataRules
            );
        }
    }

    protected function resolveDataObjectSpecificRules(
        DataProperty $dataProperty,
        array $fullPayload,
        ValidationPath $path,
        ValidationPath $propertyPath,
        DataRules $dataRules,
    ): void {
        $dataClass = $dataProperty->type->dataClass;
        $this->resolveToplevelRules(
            $dataProperty,
            $fullPayload,
            $path,
            $propertyPath,
            $dataRules
        );
        if ($dataProperty->cast instanceof DataTransferObjects\Casts\ObjectTypeCast) {
            $value = Arr::get($fullPayload, $propertyPath->get());
            $types = array_keys($dataProperty->type->getAcceptedTypes());
            $type = $types[0];
            if (is_array($value) && isset($value['objectType'])) {
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
            $dataClass = $type;
        }
        $this->execute(
            $dataClass,
            $fullPayload,
            $propertyPath,
            $dataRules,
        );
    }
}
