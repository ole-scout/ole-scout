<?php

namespace FossHaas\Lrs\DataTransferObjects;

use FossHaas\Lrs\DataTransferObjects\Attributes\Validation\KeyValueMap;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class Result extends Data
{
    public function __construct(
        public Score|Optional $score,
        public bool|Optional $success,
        public bool|Optional $completion,
        public string|Optional $response,
        #[Regex('/^P(?:\d+Y)?(?:\d+M)?(?:\d+W)?(?:\d+D)?(?:T(?:\d+H)?(?:\d+M)?(?:\d+S)?)?$/')]
        public string|Optional $duration, // ISO 8601 Duration
        /** @var array<string,mixed> */
        #[KeyValueMap('url')]
        public array|Optional $extensions,
    ) {}
}
