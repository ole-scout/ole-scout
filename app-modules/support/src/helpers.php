<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

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
