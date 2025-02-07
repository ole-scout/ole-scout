<?php

namespace FossHaas\Lrs\DataTransferObjects;

use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\KeyValueMap;
use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\LanguageTag;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class Verb extends Data
{
    public function __construct(
        #[Required]
        #[Url]
        public string $id,
        #[KeyValueMap(new LanguageTag, 'string')]
        public array|Optional $display,
    ) {}
}
