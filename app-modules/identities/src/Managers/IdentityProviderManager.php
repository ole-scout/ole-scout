<?php

namespace FossHaas\Identities\Managers;

use Illuminate\Support\Manager;

class IdentityProviderManager extends Manager
{
    /**
     * Get the default identity provider name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return null;
    }
}
