<?php

namespace FossHaas\Lrs\DataTransferObjects;

use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

#[MergeValidationRules]
class Statement extends Data
{
    public function __construct(
        #[Required]
        #[WithCast(Casts\ObjectTypeCast::class)]
        public Agent|Group $actor,
        #[Required]
        public Verb $verb,
        #[Required]
        #[WithCast(Casts\ObjectTypeCast::class)]
        public Activity|Agent|Group|StatementRef|SubStatement $object,
        #[Uuid]
        public string|Optional $id,
        public Result|Optional $result,
        public Context|Optional $context,
        public string|Optional $timestamp, // ISO 8601 Timestamp
        public string|Optional $stored, // ISO 8601 Timestamp
        #[WithCast(Casts\ObjectTypeCast::class)]
        public Agent|Group|Optional $authority,
        public string|Optional $version,
        /** @var list<Attachment> */
        public array|Optional $attachments,
    ) {}
}
