<?php

namespace FossHaas\Lrs\DataTransferObjects;

use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\KeyValueMap;
use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\LanguageTag;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class Attachment extends Data
{
    public function __construct(
        #[Required]
        #[Url]
        public string $usageType,
        #[Required]
        #[KeyValueMap(new LanguageTag, 'string')]
        public array $display,
        #[KeyValueMap(new LanguageTag, 'string')]
        public array|Optional $description,
        #[Required]
        public string $contentType,
        #[Required]
        public int $length,
        #[Required]
        #[Regex('/^[a-fA-F0-9]{64}$/')]
        public string $sha2,
        #[Url]
        public string|Optional $fileUrl,
    ) {}
}
