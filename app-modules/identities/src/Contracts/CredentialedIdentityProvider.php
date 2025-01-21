<?php

namespace FossHaas\Identities\Contracts;

interface CredentialedIdentityProvider extends IdentityProvider
{
    /**
     * Retrieve an account by its credentials.
     */
    public function getIdentityByCredentials(#[\SensitiveParameter] array $credentials): mixed;
}
