<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;

if (! function_exists('data_uri')) {
    /**
     * Convert an uploaded file to a data URI.
     * 
     * @param UploadedFile $file
     * @return string
     */
    function data_uri(UploadedFile $file): string
    {
        $mimeType = $file->getMimeType() ?? 'application/octet-stream';
        $encodedContent = base64_encode($file->getContent());
        return 'data:' . $mimeType . ';base64,' . $encodedContent;
    }
}

if (! function_exists('is_external_url')) {
    /**
     * Checks whether a given URL is external.
     * 
     * @param string $url
     * @return bool
     */
    function is_external_url(string $url): bool
    {
        if (Str::startsWith($url, config('app.url'))) return false;
        return !is_relative_url($url);
    }
}

if (! function_exists('is_relative_url')) {
    /**
     * Checks whether a given URL is relative.
     * 
     * @param string $url
     * @return bool
     */
    function is_relative_url(string $url): bool
    {
        if (preg_match('/^\w+:/', $url)) return false;
        return !Str::startsWith($url, '//');
    }
}

if (! function_exists('markdown')) {
    /**
     * Convert a markdown text to safe HTML.
     * 
     * @param string $text
     * @return string
     */
    function markdown(string $text): string
    {
        return Str::markdown($text, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }
}


if (! function_exists('as_attributes')) {
    /**
     * @param array|ComponentAttributeBag|Collection|string|HtmlString|ComponentSlot|null $attributes
     * @param array|ComponentAttributeBag|Collection|Closure|null $defaults
     * @return ComponentAttributeBag
     */
    function as_attributes(mixed $attributes, mixed $defaults = null): ComponentAttributeBag
    {
        $originalAttributes = $attributes;
        $originalDefaults = $defaults;
        if (!$attributes || is_string($attributes) || $attributes instanceof HtmlString) {
            $attributes = new ComponentAttributeBag();
        } else if ($attributes instanceof ComponentSlot) {
            $attributes = $attributes->attributes;
        } else if ($attributes instanceof Collection) {
            $attributes = new ComponentAttributeBag($attributes->all());
        } else if (is_array($attributes)) {
            $attributes = new ComponentAttributeBag($attributes);
        }
        while ($attributes->has('attributes')) {
            $class = explode(' ', $attributes->get('class'));
            $attributes = as_attributes(
                $attributes->get('attributes'),
                $attributes->except(['attributes', 'class'])
            )->class($class);
        }
        if ($defaults instanceof ComponentAttributeBag || $defaults instanceof Collection) {
            $defaults = $defaults->all();
        } else if (is_callable($defaults)) {
            $attributes = $defaults($attributes);
            $defaults = null;
        }
        if ($defaults) {
            $class = explode(' ', $attributes->get('class'));
            $attributes = as_attributes([...$attributes->except(['class']), ...$defaults])
                ->class($class);
        }
        if (count(explode(' ', $attributes->get('class') ?? '')) > 7) dd($originalAttributes, $originalDefaults, $attributes->get('class'), debug_backtrace());
        return $attributes->filter(
            fn($value) => $value !== null && $value !== false
        );
    }
}

if (! function_exists('as_slot')) {
    /**
     * @param string|HtmlString|ComponentSlot|Closure $contents
     * @param array|ComponentAttributeBag|Collection|Closure|null $attributes
     * @return ComponentSlot
     */
    function as_slot(mixed $contents, mixed $attributes = null): ComponentSlot
    {
        if (is_callable($contents)) {
            $contents = $contents();
        }
        if ($contents instanceof ComponentSlot) {
            $attributes = as_attributes(
                $contents->attributes,
                $attributes
            );
            $contents = $contents->toHtml();
        }
        if (!($attributes instanceof ComponentAttributeBag) && is_callable($attributes)) {
            $attributes = $attributes(new ComponentAttributeBag());
        } else if (is_array($attributes)) {
            $attributes = new ComponentAttributeBag($attributes);
        }
        $slot = new ComponentSlot($contents);
        $slot->attributes = $attributes;
        return $slot;
    }
}

if (! function_exists('render_slot')) {
    /**
     * @param string|HtmlString|ComponentSlot|Closure $slot
     * @param array|ComponentAttributeBag|Collection|Closure|null $attributes
     * @param bool|null $allowEmpty
     */
    function render_slot(mixed $slot, mixed $attributes = null, ?bool $allowEmpty = null): HtmlString
    {
        if (is_callable($slot)) {
            $slot = $slot();
        }
        if ($slot instanceof ComponentSlot) {
            $slot = as_slot($slot, $attributes);
            $attributes = $slot->attributes;
            $slot = $slot->toHtml();
        } else if (!($attributes instanceof ComponentAttributeBag) && is_callable($attributes)) {
            $attributes = $attributes(new ComponentAttributeBag());
        } else {
            $attributes = as_attributes($attributes);
        }
        if ($attributes->has('component')) {
            $component = $attributes->get('component');
            $attributes = $attributes->except(['component']);
            return new HtmlString(Blade::render(
                '<x-dynamic-component :$component :$attributes>{{ $slot }}</x-dynamic-component>',
                [
                    'component' => $component,
                    'attributes' => $attributes,
                    'slot' => new HtmlString($slot),
                ]
            ));
        }
        $as = $attributes->get('as') ?? 'div';
        // List of void elements from html.spec.whatwg.org
        $isVoid = in_array($as, [
            'area',
            'base',
            'br',
            'col',
            'embed',
            'hr',
            'img',
            'input',
            'link',
            'meta',
            'source',
            'track',
            'wbr'
        ]);
        // Make an exception for empty void elements if allowEmpty is unset
        if ($attributes->isEmpty() && !trim((string) $slot) && (
            $isVoid ? $allowEmpty === false : !$allowEmpty
        )) {
            return new HtmlString('');
        }
        $attributes = $attributes->except(['as']);
        return new HtmlString(Blade::render(
            $isVoid ? '<{{ $as }} {{ $attributes }}>' :
                '<{{ $as }} {{ $attributes }}>{{ $slot }}</{{ $as }}>',
            [
                'as' => $as,
                'attributes' => $attributes,
                'slot' => new HtmlString($slot),
            ]
        ));
    }
}
