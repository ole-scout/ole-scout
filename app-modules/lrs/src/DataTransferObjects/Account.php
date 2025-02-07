<?php

namespace FossHaas\Lrs\DataTransferObjects;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

class Account extends Data
{
    public function __construct(
        #[Required]
        #[Url]
        public string $homePage,
        #[Required]
        public string $name,
    ) {}
}
