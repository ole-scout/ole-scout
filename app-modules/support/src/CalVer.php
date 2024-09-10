<?php

namespace FossHaas\Support;

use Illuminate\Support\Arr;

class CalVer
{
    public function __construct(
        private bool $fullYear = false,
        private bool $minorIsDay = false
    ) {
        //
    }

    public function parse(string $version): array
    {
        $matches = [];
        $valid = preg_match('/^(?P<year>(\d{2}|\d{4}))\.(?P<month>\d{1,2})\.(?P<minor>\d+)(?:-(?P<patch>\d+))?$/', $version, $matches);
        if (!$valid) {
            throw new \InvalidArgumentException(
                'Not a well-formed CalVer version: ' . $version
            );
        }
        if ($this->fullYear && strlen($matches['year']) === 2) {
            $matches['year'] = '20' . $matches['year'];
        }
        return Arr::mapWithKeys(
            ['year', 'month', 'minor', 'patch'],
            fn($key) => [$key => isset($matches[$key]) ? intval($matches[$key]) : 0],
        );
    }

    protected function year(): int
    {
        return intval(date($this->fullYear ? 'Y' : 'y'));
    }

    protected function month(): int
    {
        return intval(date('n'));
    }

    protected function minor(): int
    {
        return $this->minorIsDay ? intval(date('j')) : 0;
    }

    public function __invoke(): string
    {
        return $this->format([
            'year' => $this->year(),
            'month' => $this->month(),
            'minor' => $this->minor(),
        ]);
    }

    public function format(array $version): string
    {
        if (!isset($version['year']) || !is_int($version['year']) || $version['year'] < 0) {
            throw new \InvalidArgumentException('Missing or invalid year');
        }
        if (!isset($version['month']) || !is_int($version['month']) || $version['month'] < 0) {
            throw new \InvalidArgumentException('Missing or invalid month');
        }
        if (!isset($version['minor']) || !is_int($version['minor']) || $version['minor'] < 0) {
            throw new \InvalidArgumentException('Missing or invalid minor');
        }
        $calver = join('.', [$version['year'], $version['month'], $version['minor']]);
        if (isset($version['patch'])) {
            if (!is_int($version['patch']) || $version['patch'] < 0) {
                throw new \InvalidArgumentException('Invalid patch');
            }
            if ($version['patch'] > 0) {
                return $calver . '-' . $version['patch'];
            }
        }
        return $calver;
    }

    public function increment(string $version): string
    {
        $currentYear = $this->year();
        $currentMonth = $this->month();
        $currentMinor = $this->minor();
        $parsed = self::parse($version);

        if (
            $parsed['year'] > $currentYear || (
                $parsed['year'] === $currentYear && (
                    $parsed['month'] > $currentMonth || (
                        $parsed['month'] === $currentMonth && (
                            !$this->minorIsDay || $parsed['minor'] >= $currentMinor
                        )
                    )
                )
            )
        ) {
            return $this->format(
                $this->minorIsDay ?
                    [...$parsed, 'patch' => $parsed['patch'] + 1] :
                    [...$parsed, 'minor' => $parsed['minor'] + 1, 'patch' => 0]
            );
        }
        return $this();
    }
}
