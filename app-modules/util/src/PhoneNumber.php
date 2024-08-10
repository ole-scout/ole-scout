<?php

namespace FossHaas\Util;

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class PhoneNumber
{
    public static function formatUri(string $phone): string
    {
        return self::_format($phone, PhoneNumberFormat::RFC3966);
    }

    public static function format(string $phone): string
    {
        return self::_format($phone, PhoneNumberFormat::INTERNATIONAL);
    }

    protected static function _format(string $phone, int $format): string
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $parsed = $phoneUtil->parse($phone);
        return $phoneUtil->format($parsed, $format);
    }
}
