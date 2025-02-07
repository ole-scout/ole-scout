<?php

namespace FossHaas\Lrs\DataTransferObjects;

use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class ContextAgent extends Data
{
    public function __construct(
        #[Required]
        #[In('contextAgent')]
        public string $objectType,
        #[Required]
        public Agent $agent,
        public array|Optional $relevantTypes,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'relevantTypes' => ['sometimes', 'list', 'min:1'],
            'relevantTypes.*' => ['url'],
        ];
    }
}
