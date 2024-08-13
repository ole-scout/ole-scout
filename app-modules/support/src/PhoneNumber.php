<?php

namespace FossHaas\Support;

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class PhoneNumber
{
    public static function formatUri(string $phone, ?string $defaultRegion = null): string
    {
        return self::_format($phone, PhoneNumberFormat::RFC3966, $defaultRegion);
    }

    public static function format(string $phone, ?string $defaultRegion = null): string
    {
        return self::_format($phone, PhoneNumberFormat::INTERNATIONAL, $defaultRegion);
    }

    protected static function _format(string $phone, int $format, ?string $defaultRegion = null): string
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $parsed = $phoneUtil->parse($phone, $defaultRegion);
        return $phoneUtil->format($parsed, $format);
    }
}
