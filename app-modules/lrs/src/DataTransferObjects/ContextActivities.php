<?php

namespace FossHaas\Lrs\DataTransferObjects;

use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ContextActivities extends Data
{
    public function __construct(
        /** @var list<Activity> */
        #[WithCast(Casts\ListOrItemCast::class)]
        public array|Optional $parent,
        /** @var list<Activity> */
        #[WithCast(Casts\ListOrItemCast::class)]
        public array|Optional $grouping,
        /** @var list<Activity> */
        #[WithCast(Casts\ListOrItemCast::class)]
        public array|Optional $category,
        /** @var list<Activity> */
        #[WithCast(Casts\ListOrItemCast::class)]
        public array|Optional $other,
    ) {}
}
