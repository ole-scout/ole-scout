<?php

namespace App\Hashing\Data;

use Spatie\LaravelData\Attributes\Validation\RequiredIf;
use Spatie\LaravelData\Data;

class FoxxAuthData extends Data
{
    public function __construct(
        public string $method,
        #[RequiredIf('method', 'pbkdf2')]
        public int $iter,
        public string $salt,
        public string $hash,
    ) {}
}
