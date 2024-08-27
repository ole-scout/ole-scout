<?php

use Illuminate\Http\UploadedFile;

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
