<?php

namespace FossHaas\Lrs\DataTransferObjects;

use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\KeyValueMap;
use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\LanguageTag;
use Spatie\LaravelData\Attributes\Validation\Distinct;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class InteractionComponent extends Data
{
    public function __construct(
        #[Required]
        #[Distinct]
        public string $id,
        #[KeyValueMap(new LanguageTag, 'string')]
        public array|Optional $description,
    ) {}
}
