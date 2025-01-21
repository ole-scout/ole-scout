<?php

namespace FossHaas\Identities\Enums;

use Illuminate\Support\Arr;

enum IdentityProviderType: string
{
    case LDAP = 'ldap';
    case OIDC = 'oidc';

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
            self::LDAP => __('LDAP authentication'),
            self::OIDC => __('OpenID Connect authentication'),
        };
    }
}
