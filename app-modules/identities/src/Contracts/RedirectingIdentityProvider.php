<?php

namespace FossHaas\Identities\Contracts;

interface RedirectingIdentityProvider extends IdentityProvider
{
    /**
     * Create the redirect URL for the identity provider.
     */
    public function createRedirectUrl(): string;

    /**
     * Handle the redirect response from the identity provider.
     *
     * @return \App\Models\User|null
     */
    public function handleRedirectResponse(array $response): mixed;
}
