<?php

namespace FossHaas\Lrs\DataTransferObjects\ActivityDefinitions;

use FossHaas\Lrs\DataTransferObjects\ActivityDefinition;
use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\KeyValueMap;
use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\LanguageTag;
use FossHaas\Lrs\DataTransferObjects\InteractionComponent;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Optional;

class PerformanceActivityDefinition extends ActivityDefinition
{
    public const INTERACTION_TYPE = 'performance';

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
        #[In(self::INTERACTION_TYPE)]
        public string $interactionType,
        /** @var list<InteractionComponent> */
        public array|Optional $steps,
        /** @var list<string> */
        public array|Optional $correctResponsesPattern,
    ) {
        parent::__construct($name, $description, $type, $moreInfo, $extensions);
    }
}
