<?php

namespace FossHaas\Util;

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class PhoneNumber
{
    public static function format(string $phone): string
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $parsed = $phoneUtil->parse($phone);
        return $phoneUtil->format($parsed, PhoneNumberFormat::INTERNATIONAL);
    }
}
