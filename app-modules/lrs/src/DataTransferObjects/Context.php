<?php

namespace FossHaas\Lrs\DataTransferObjects;

use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\KeyValueMap;
use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\LanguageTag;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class Context extends Data
{
    public function __construct(
        #[WithCast(Casts\ObjectTypeCast::class)]
        public Agent|Group|Optional $instructor,
        #[WithCast(Casts\ObjectTypeCast::class)]
        public Group|Optional $team,
        public ContextActivities|Optional $contextActivities,
        /** @var list<ContextAgent> */
        public array|Optional $contextAgents,
        /** @var list<ContextGroup> */
        public array|Optional $contextGroups,
        public string|Optional $revision,
        public string|Optional $platform,
        #[LanguageTag()]
        public string|Optional $language,
        public StatementRef|Optional $statement,
        /** @var array<string,mixed> */
        #[KeyValueMap('url')]
        public array|Optional $extensions,
    ) {}
}
