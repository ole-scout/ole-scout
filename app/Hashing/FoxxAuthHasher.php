<?php

namespace App\Hashing;

use App\Hashing\Data\FoxxAuthData;
use Error;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Hashing\AbstractHasher;
use Illuminate\Support\Arr;
use RuntimeException;

class FoxxAuthHasher extends AbstractHasher implements HasherContract
{
    /**
     * The default hash method.
     *
     * @var string
     */
    protected $hashMethod = 'sha256';

    /**
     * The default PBKDF2 salt length.
     *
     * @var int
     */
    protected $saltLength = 16;

    /**
     * The default PBKDF2 work factor.
     *
     * @var int
     */
    protected $workFactor = 1;

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
        $this->hashMethod = $options['method'] ?? $this->hashMethod;
        $this->saltLength = $options['saltLength'] ?? $this->saltLength;
        $this->workFactor = $options['workFactor'] ?? $this->workFactor;
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
        $salt = $this->salt($options);
        $method = $this->hashMethod($options);

        if ($method !== 'pbkdf2') {
            if (! in_array($method, hash_algos())) {
                throw new RuntimeException(strtoupper($method).' hashing not supported.');
            }
            $hash = hash($method, "{$salt}{$value}");

            return FoxxAuthData::from([
                'method' => $method,
                'salt' => $salt,
                'hash' => $hash,
            ])->toJson();
        }

        try {
            $iter = $this->iter($options);
            $hash = hash_pbkdf2('sha1', $value, $salt, $iter, 32);
        } catch (Error) {
            throw new RuntimeException('PBKDF2 hashing not supported.');
        }

        return FoxxAuthData::from([
            'method' => 'pbkdf2',
            'iter' => $iter,
            'salt' => $salt,
            'hash' => $hash,
        ])->toJson();
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

        try {
            $authData = FoxxAuthData::from($hashedValue);
        } catch (Error) {
            if ($this->verifyAlgorithm) {
                throw new RuntimeException('This password does not use the Foxx Auth hashing algorithms.');
            }

            return parent::check($value, $hashedValue, $options);
        }

        if ($authData->method !== 'pbkdf2') {
            if (! in_array($authData->method, hash_algos())) {
                throw new RuntimeException(strtoupper($authData->method).' hashing not supported.');
            }
            $generatedHash = hash($authData->method, "{$authData->salt}{$value}");
        } else {
            $generatedHash = hash_pbkdf2('sha1', $value, $authData->salt, $authData->iter, 32);
        }

        return hash_equals($authData->hash, $generatedHash);
    }

    /**
     * Get information about the given hashed value.
     *
     * @param  string  $hashedValue
     * @return array
     */
    public function info($hashedValue)
    {
        $authData = json_decode($hashedValue, true);

        if (! is_array($authData)) {
            return parent::info($hashedValue);
        }

        return [
            'algo' => 'x-foxx-auth',
            'algoName' => 'foxx-auth',
            'options' => Arr::except($authData, ['hash']),
        ];
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param  string  $hashedValue
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        $info = $this->info($hashedValue);

        if ($info['algo'] !== 'x-foxx-auth') {
            return true;
        }

        if ($info['options']['method'] !== $this->hashMethod($options)) {
            return true;
        }

        if (strlen($info['options']['salt']) < $this->saltLength($options)) {
            return true;
        }

        if ($info['options']['method'] === 'pbkdf2') {
            return $info['options']['iter'] < $this->iter($options);
        }

        return false;
    }

    /**
     * Verifies that the configuration is less than or equal to what is configured.
     *
     * @internal
     */
    public function verifyConfiguration($value)
    {
        $info = $this->info($value);

        if ($info['algo'] !== 'x-foxx-auth') {
            return false;
        }

        if ($info['options']['method'] !== $this->hashMethod) {
            return false;
        }

        if (strlen($info['options']['salt']) !== $this->saltLength) {
            return false;
        }

        if ($info['options']['method'] === 'pbkdf2') {
            return $info['options']['iter'] <= $this->iter();
        }

        return true;
    }

    /**
     * Set the default password salt length.
     *
     * @param  int  $saltLength
     * @return $this
     */
    public function setSaltLength($saltLength)
    {
        $this->saltLength = (int) $saltLength;

        return $this;
    }

    /**
     * Set the default password work factor.
     *
     * @param  int  $workFactor
     * @return $this
     */
    public function setWorkFactor($workFactor)
    {
        $this->workFactor = (int) $workFactor;

        return $this;
    }

    /**
     * Extract the method value from the options array.
     *
     * @return string
     */
    protected function hashMethod(array $options = [])
    {
        $hashMethod = $options['method'] ?? $this->hashMethod;

        return $hashMethod;
    }

    /**
     * Extract the password salt length value from the options array.
     *
     * @return string
     */
    protected function saltLength(array $options = [])
    {
        $saltLength = $options['saltLength'] ?? $this->saltLength;

        return $saltLength;
    }

    /**
     * Generate a random salt value.
     *
     * @return string
     */
    protected function salt(array $options = [])
    {
        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*(){}[]:;<>,.?/|';
        $maxInt = strlen($pool) - 1;
        $saltLength = $this->saltLength($options);

        $salt = '';
        for ($i = 0; $i < $saltLength; $i++) {
            $salt .= $pool[random_int(0, $maxInt)];
        }

        return $salt;
    }

    /**
     * Extract the work factor from the options array.
     *
     * @return int
     */
    protected function workFactor(array $options = [])
    {
        $workFactor = $options['workFactor'] ?? $this->workFactor;

        return $workFactor;
    }

    /**
     * Extract the iter value from the options array.
     *
     * @return int
     */
    protected function iter(array $options = [])
    {
        $daysPerYear = 365.242199;
        $y2k = strtotime('2000-01-01Z');
        $now = time();
        $years = ($now - $y2k) / ($daysPerYear * 24 * 60 * 60);
        $workFactor = $this->workFactor($options);

        return intval(1000 * pow(2, $years / 2) * $workFactor);
    }
}
