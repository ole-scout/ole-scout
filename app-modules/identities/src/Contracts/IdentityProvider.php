<?php

namespace FossHaas\Identities\Contracts;

interface IdentityProvider
{
    /**
     * Retrieve an identity by its identifier.
     */
    public function getIdentityByIdentifier(string $identifier): mixed;

    /**
     * Retrieve all identities.
     *
     * @return array<int, mixed>|null
     */
    public function getAllIdentities(): mixed;
}
