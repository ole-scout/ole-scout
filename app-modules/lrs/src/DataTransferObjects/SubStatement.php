<?php

namespace FossHaas\Lrs\DataTransferObjects;

use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class SubStatement extends Data
{
    public function __construct(
        #[In('SubStatement')]
        public string $objectType,
        #[WithCast(Casts\ObjectTypeCast::class)]
        public Agent|Group $actor,
        public Verb $verb,
        #[WithCast(Casts\ObjectTypeCast::class)]
        public Activity|Agent|Group $object,
        public Result|Optional $result,
        public Context|Optional $context,
        /** @var list<Attachment> */
        public array|Optional $attachments,
    ) {}
}
