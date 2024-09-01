<?php

namespace FossHaas\Ui;

if (! function_exists('FossHaas\Ui\buttonStyles')) {
    function buttonStyles(string $intent, string $variant, $disabled = false, $small = false, $plain = false): string
    {
        $variants = [
            'default' => [
                'normal' => 'text-white dark:text-zinc-950 bg-zinc-600 dark:bg-white hover:bg-zinc-800 dark:hover:bg-zinc-200 shadow-sm shadow-sheen-zinc-900/50 dark:shadow-sheen-none font-semibold',
                'alt' => 'text-zinc-600 dark:text-zinc-200 dark:hover:text-zinc-100 bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800 shadow-sm shadow-border-zinc-900 dark:shadow-border-zinc-50 font-semibold',
                'ghost' => 'text-zinc-600 dark:text-zinc-200 dark:hover:text-zinc-100 bg-transparent hover:bg-zinc-50 dark:hover:bg-zinc-800 hover:shadow-border-zinc-900 dark:hover:shadow-border-zinc-50 font-semibold',
                'link' => 'text-zinc-600 dark:text-zinc-200 bg-transparent hover:underline',
            ],
            'primary' => [
                'normal' => 'text-white bg-primary-600 hover:bg-primary-800 shadow-sm shadow-sheen-primary-900/50 dark:shadow-sheen-none font-semibold',
                'alt' => 'text-primary-600 dark:text-primary-500 dark:hover:text-primary-400 bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800 shadow-sm shadow-border-zinc-900 dark:shadow-border-zinc-50 font-semibold',
                'ghost' => 'text-primary-600 dark:text-primary-500 dark:hover:text-primary-400 bg-transparent hover:bg-zinc-50 dark:hover:bg-zinc-800 hover:shadow-border-zinc-900 dark:hover:shadow-border-zinc-50 font-semibold',
                'link' => 'text-primary-600 dark:text-primary-500 bg-transparent hover:underline',
            ],
            'danger' => [
                'normal' => 'text-white bg-red-600 hover:bg-red-800 shadow-sm shadow-sheen-red-900/50 dark:shadow-sheen-none font-semibold',
                'alt' => 'text-red-600 dark:text-red-500 dark:hover:text-red-400 bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800 shadow-sm shadow-border-zinc-900 dark:shadow-border-zinc-50 font-semibold',
                'ghost' => 'text-red-600 dark:text-red-500 dark:hover:text-red-400 bg-transparent hover:bg-zinc-50 dark:hover:bg-zinc-800 hover:shadow-border-zinc-900 dark:hover:shadow-border-zinc-50 font-semibold',
                'link' => 'text-red-600 dark:text-red-500 bg-transparent hover:underline',
            ],
            'success' => [
                'normal' => 'text-white bg-green-600 hover:bg-green-800 shadow-sm shadow-sheen-green-900/50 dark:shadow-sheen-none font-semibold',
                'alt' => 'text-green-600 dark:text-green-500 dark:hover:text-green-400 bg-white dark:bg-zinc-900 hover:bg-zinc-50 dark:hover:bg-zinc-800 shadow-sm shadow-border-zinc-900 dark:shadow-border-zinc-50 font-semibold',
                'ghost' => 'text-green-600 dark:text-green-500 dark:hover:text-green-400 bg-transparent hover:bg-zinc-50 dark:hover:bg-zinc-800 hover:shadow-border-zinc-900 dark:hover:shadow-border-zinc-50 font-semibold',
                'link' => 'text-green-600 dark:text-green-500 bg-transparent hover:underline',
            ],
            'disabled' => [
                'normal' => 'text-stone-400 dark:text-stone-500 bg-stone-100 dark:bg-stone-900 font-semibold',
                'alt' => 'text-stone-400 dark:text-stone-500 bg-stone-100 dark:bg-stone-900 font-semibold',
                'ghost' => 'text-stone-400 dark:text-stone-500 bg-transparent font-semibold',
                'link' => 'text-stone-400 dark:text-stone-500 bg-transparent',
            ],
        ];
        if ($variant === 'neutral') return '';
        $css = ['inline flex items-center'];
        if ($variant === 'link') {
            if ($small) $css[] = 'text-sm';
        } else {
            if (!$plain) $css[] = $small ? 'px-2 py-1' : 'px-3 py-2';
            $css[] = 'leading-tight hover:no-underline rounded-md';
            $css[] = $small ? 'text-xs' : 'text-sm';
        }
        $css[] = $disabled ? 'cursor-not-allowed' : 'cursor-pointer';
        if (!$plain) $css[] = $variants[$disabled ? 'disabled' : $intent][$variant];
        return join(' ', $css);
    }
}
