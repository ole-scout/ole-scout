<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
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
     * @param array|ComponentAttributeBag|Collection|null $defaults
     * @return ComponentAttributeBag
     */
    function as_attributes(mixed $attributes, mixed $defaults = null): ComponentAttributeBag
    {
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
            $class = $attributes->get('class') ?? [];
            if (!is_array($class)) $class = explode(' ', (string) $class);
            $attributes = as_attributes(
                $attributes->get('attributes'),
                $attributes->except(['attributes', 'class'])
            )->class($class);
        }
        if ($defaults instanceof ComponentAttributeBag || $defaults instanceof Collection) {
            $defaults = $defaults->all();
        }
        if ($defaults) {
            if (isset($defaults['class'])) {
                $class = $defaults['class'];
                $defaults = Arr::except($defaults, 'class');
                if (!is_array($class)) $class = explode(' ', (string) $class);
            }
            $attributes = $attributes->merge($defaults, false);
            if (isset($class)) $attributes = $attributes->class($class);
        }
        return $attributes->filter(
            fn($value) => $value !== null && $value !== false
        );
    }
}

if (! function_exists('as_slot')) {
    /**
     * @param string|HtmlString|ComponentSlot|ComponentAttributeBag|Closure $contents
     * @param array|ComponentAttributeBag|Collection|null $attributes
     * @return ComponentSlot
     */
    function as_slot(mixed $contents, mixed $attributes = null): ComponentSlot
    {
        if ($contents instanceof ComponentAttributeBag) {
            $attributes = as_attributes($contents, $attributes);
            $contents = '';
        } else if (!is_string($contents) && is_callable($contents)) {
            $contents = $contents();
        } else if ($contents instanceof ComponentSlot) {
            if ($attributes) {
                $contents->attributes = as_attributes(
                    $contents->attributes,
                    $attributes
                );
            }
            return $contents;
        }

        if (!$contents) $contents = '';
        elseif (!is_string($contents)) $contents = (string) $contents;
        if (!$attributes) return new ComponentSlot($contents);

        $slot = new ComponentSlot($contents);
        $slot->attributes = as_attributes($attributes);
        return $slot;
    }
}

if (! function_exists('render_slot')) {
    function render_slot(
        ComponentSlot|HtmlString|string|null $slot,
        ComponentAttributeBag|array|null $attributes = null,
        ?Closure $transform = null,
        ?string $fallbackTag = null,
    ): HtmlString {
        if ($slot instanceof HtmlString) $contents = $slot;
        else if (!$slot) $contents = new HtmlString();
        else if ($slot instanceof ComponentSlot) {
            $contents = new HtmlString($slot->toHtml());
            if ($attributes instanceof ComponentAttributeBag) {
                $attributes = $attributes->all();
            }
            $attributes = ($attributes
                ? as_attributes($slot->attributes, $attributes)
                : $slot->attributes
            );
        } else $contents = new HtmlString((string) $slot);
        if ($transform) $contents = $transform($contents);

        if (!$attributes) $attributes = new ComponentAttributeBag();
        else $attributes = as_attributes($attributes);

        if ($attributes->has('callback')) {
            $callback = $attributes->get('callback');
            $attributes = $attributes->except('callback');
            return new HtmlString((string) $callback($attributes, $contents));
        }

        if ($attributes->has('component')) {
            return new HtmlString(Blade::render(
                '<x-dynamic-component :$component :$attributes>{{ $contents }}</x-dynamic-component>',
                [
                    'attributes' => $attributes->except('component'),
                    'component' => $attributes->get('component'),
                    'contents' => $contents,
                ]
            ));
        }

        $tag = $fallbackTag ?? 'div';
        if ($attributes->has('as')) {
            $tag = $attributes->get('as');
            $attributes = $attributes->except('as');
        }
        return new HtmlString(Blade::render(
            '<{{ $tag }} {{ $attributes }}>{{ $contents }}</{{ $tag }}>',
            [
                'tag' => $tag,
                'attributes' => $attributes,
                'contents' => $contents,
            ]
        ));
    }
}
