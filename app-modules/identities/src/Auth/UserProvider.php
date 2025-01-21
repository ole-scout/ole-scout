<?php

namespace FossHaas\Identities\Auth;

use Closure;
use FossHaas\Identities\Models\Account;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class UserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(#[\SensitiveParameter] array $credentials)
    {
        $account = $this->retrieveAccountByLocalCredentials($credentials);

        if (! $account->user) {
            // Shared accounts create a new user for each login
            // NOTE: We shouldn't save the user here because this method is
            // also used by Laravel before checking whether the credentials are
            // actually valid!
            /** @var \App\Models\User */
            $user = $this->createModel()->fill([
                'account_id' => $account->id,
            ]);

            return $user;
        }

        return $account->user;
    }

    protected function retrieveAccountByLocalCredentials(#[\SensitiveParameter] array $credentials)
    {
        $credentials = array_filter(
            $credentials,
            fn ($key) => ! str_contains($key, 'password'),
            ARRAY_FILTER_USE_KEY
        );

        if (empty($credentials)) {
            return null;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = Account::query();

        foreach ($credentials as $key => $value) {
            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } elseif ($value instanceof Closure) {
                $value($query);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function validateCredentials(UserContract $user, #[\SensitiveParameter] array $credentials)
    {
        if (! isset($credentials['password'])) {
            return false;
        }

        return parent::validateCredentials($user, $credentials);
    }

    /**
     * Rehash the user's password if required and supported.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function rehashPasswordIfRequired(UserContract $user, #[\SensitiveParameter] array $credentials, bool $force = false)
    {
        $account = $user->account;

        if (! $this->hasher->needsRehash($account->password) && ! $force) {
            return;
        }

        $account->forceFill([
            'password' => $this->hasher->make($credentials['password']),
        ])->save();
    }
}
