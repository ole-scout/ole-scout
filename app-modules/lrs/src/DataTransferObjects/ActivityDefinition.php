<?php

namespace FossHaas\Lrs\DataTransferObjects;

use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\KeyValueMap;
use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\LanguageTag;
use FossHaas\Lrs\Enums\InteractionType;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Castable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class ActivityDefinition extends Data implements Castable
{
    public function __construct(
        /** @var array<string,string> */
        #[KeyValueMap(new LanguageTag, 'string')]
        public array|Optional $name,
        /** @var array<string,string> */
        #[KeyValueMap(new LanguageTag, 'string')]
        public array|Optional $description,
        #[Url]
        public string|Optional $type,
        #[Url]
        public string|Optional $moreInfo,
        /** @var array<string,mixed> */
        #[KeyValueMap('url')]
        public array|Optional $extensions,
    ) {}

    public static function dataCastUsing(array $arguments = []): Cast
    {
        return new class implements Cast
        {
            public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
            {
                if (! isset($value['interactionType'])) {
                    return ActivityDefinition::from($value);
                }

                $type = InteractionType::from($value['interactionType']);

                return match ($type) {
                    InteractionType::CHOICE => ActivityDefinitions\ChoiceActivityDefinition::from($value),
                    InteractionType::FILL_IN => ActivityDefinitions\FillInActivityDefinition::from($value),
                    InteractionType::LIKERT => ActivityDefinitions\LikertActivityDefinition::from($value),
                    InteractionType::MATCHING => ActivityDefinitions\MatchingActivityDefinition::from($value),
                    InteractionType::PERFORMANCE => ActivityDefinitions\PerformanceActivityDefinition::from($value),
                    InteractionType::TRUE_FALSE => ActivityDefinitions\TrueFalseActivityDefinition::from($value),
                    InteractionType::OTHER => ActivityDefinitions\OtherActivityDefinition::from($value),
                };
            }
        };
    }
}
