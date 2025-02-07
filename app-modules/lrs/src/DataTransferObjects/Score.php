<?php

namespace FossHaas\Lrs\DataTransferObjects;

use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class Score extends Data
{
    public function __construct(
        #[Between(-1.0, 1.0)]
        public float|Optional $scaled,
        public float|Optional $raw,
        public float|Optional $min,
        public float|Optional $max,
    ) {}
}
