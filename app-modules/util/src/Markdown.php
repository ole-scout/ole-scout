<?php

namespace FossHaas\Util;

use Illuminate\Support\Str;

class Markdown
{
    public static function markdown(string $text): string
    {
        return Str::of($text)->markdown([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }
}
