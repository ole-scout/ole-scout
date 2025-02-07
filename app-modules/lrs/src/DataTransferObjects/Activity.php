<?php

namespace FossHaas\Lrs\DataTransferObjects;

use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Attributes\WithCastable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class Activity extends Data
{
    public function __construct(
        #[Required]
        #[Url]
        public string $id,
        #[In('Activity')]
        public string|Optional $objectType,
        #[WithCastable(ActivityDefinition::class)]
        public ActivityDefinition|Optional $definition,
    ) {}
}
