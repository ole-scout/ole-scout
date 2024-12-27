<?php

namespace FossHaas\Identities\Enums;

use Illuminate\Support\Arr;

enum IdentityProviderType: string
{
    case LOCAL = 'local';

    public static function values(): array
    {
        return Arr::map(
            self::cases(),
            fn (IdentityProviderType $case) => $case->value
        );
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::LOCAL => __('Local authentication'),
        };
    }
}
