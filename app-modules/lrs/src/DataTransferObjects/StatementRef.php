<?php

namespace FossHaas\Lrs\DataTransferObjects;

use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;

class StatementRef extends Data
{
    public function __construct(
        #[Required]
        #[Uuid]
        public string $id,
        #[Required]
        #[In('StatementRef')]
        public string $objectType,
    ) {}
}
