<?php

namespace FossHaas\Identities\Data;

use Spatie\LaravelData\Data;

class ProfileData extends Data
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public ?string $company,
        public ?string $department,
        public ?string $job_title,
        public ?int $created_at,
        public ?int $updated_at,
    ) {}
}
