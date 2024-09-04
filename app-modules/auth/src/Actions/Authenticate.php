<?php

namespace FossHaas\Auth\Actions;

use FossHaas\Auth\Exceptions\AuthenticationFailure;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class Authenticate
{
    public function handle(array $credentials, bool $remember = false): void
    {
        $this->ensureIsNotRateLimited($credentials['email']);

        if (! Auth::attempt($credentials, $remember)) {
            RateLimiter::hit($this->throttleKey($credentials['email']));

            throw new AuthenticationFailure(trans('auth.failed'));
        }

        RateLimiter::clear($this->throttleKey($credentials['email']));
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(string $email): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($email), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey($email));

        throw new AuthenticationFailure(trans('auth.throttle', [
            'seconds' => $seconds,
            'minutes' => ceil($seconds / 60),
        ]));
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(string $email): string
    {
        return Str::transliterate(Str::lower($email) . '|' . request()->ip());
    }
}
