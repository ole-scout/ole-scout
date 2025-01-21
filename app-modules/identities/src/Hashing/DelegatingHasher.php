<?php

namespace FossHaas\Identities\Hashing;

use Closure;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Hashing\AbstractHasher;
use InvalidArgumentException;
use RuntimeException;

class DelegatingHasher extends AbstractHasher implements HasherContract
{
    /**
     * The default rules.
     *
     * @var array<string,string|\Closure>
     */
    protected $rules = [];

    /**
     * Indicates whether to perform an algorithm check.
     *
     * @var bool
     */
    protected $verifyAlgorithm = false;

    /**
     * Create a new hasher instance.
     *
     * @return void
     */
    public function __construct(array $options = [])
    {
        $this->rules = $options['rules'] ?? [];
        $this->verifyAlgorithm = $options['verify'] ?? $this->verifyAlgorithm;
    }

    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @return string
     *
     * @throws \RuntimeException
     */
    public function make(#[\SensitiveParameter] $value, array $options = [])
    {
        return $this->driver()->make($value, $options);
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param  string  $value
     * @param  string  $hashedValue
     * @return bool
     *
     * @throws \RuntimeException
     */
    public function check(#[\SensitiveParameter] $value, $hashedValue, array $options = [])
    {
        if (! is_string($hashedValue) || strlen($hashedValue) === 0) {
            return false;
        }

        $driver = $this->match($hashedValue);

        if ($driver) {
            return $this->driver($driver)->check($value, $hashedValue, $options);
        }

        if ($this->verifyAlgorithm) {
            throw new RuntimeException('This password does not use any registered algorithm.');
        }

        return parent::check($value, $hashedValue, $options);
    }

    /**
     * Get information about the given hashed value.
     *
     * @param  string  $hashedValue
     * @return array
     */
    public function info($hashedValue)
    {
        $driver = $this->match($hashedValue);

        if ($driver) {
            return $this->driver($driver)->info($hashedValue);
        }

        return parent::info($hashedValue);
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param  string  $hashedValue
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        return $this->driver()->needsRehash($hashedValue, $options);
    }

    /**
     * Verifies that the configuration is less than or equal to what is configured.
     *
     * @internal
     */
    public function verifyConfiguration($value)
    {
        $driver = $this->match($value);

        if (! $driver) {
            return false;
        }

        return $this->driver($driver)->verifyConfiguration($value);
    }

    /**
     * Set the default rules.
     *
     * @param  array<string,string|\Closure>  $rules
     * @return $this
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Extract the rules value from the options array.
     *
     * @return array<string,string|\Closure>
     */
    protected function rules(array $options = [])
    {
        $rules = $options['rules'] ?? $this->rules;

        return $rules;
    }

    /**
     * Get the default driver name.
     *
     * @return string|null
     */
    public function getDefaultDriver()
    {
        return array_key_first($this->rules);
    }

    /**
     * Get the hasher for the given driver name.
     *
     * @param  string|null  $driver
     * @return \Illuminate\Contracts\Hashing\Hasher
     */
    public function driver($driver = null)
    {
        $driver = $driver ?: $this->getDefaultDriver();

        if ($driver === null) {
            throw new InvalidArgumentException(sprintf(
                'Unable to resolve NULL driver for [%s].', static::class
            ));
        }

        return app('hash')->driver($driver);
    }

    /**
     * Returns the driver name that matches the given hashed value.
     *
     * @return string|null
     */
    protected function match($hashedValue)
    {
        foreach ($this->rules as $driver => $match) {
            if ($match instanceof Closure) {
                if (! $match($hashedValue)) {
                    continue;
                }
            } elseif (is_string($match)) {
                if (preg_match($match, $hashedValue) !== 1) {
                    continue;
                }
            }

            return $driver;
        }

        return null;
    }
}
