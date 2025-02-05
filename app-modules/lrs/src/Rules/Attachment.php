<?php

namespace FossHaas\Lrs\Rules;

use FossHaas\Validation\ArrayValidationRule;
use FossHaas\Validation\Rules\RecordOf;

class Attachment extends ArrayValidationRule
{
    public function __construct()
    {
        $this->rules = [
            'usageType' => ['string', 'url'],
            'display' => ['sometimes', ...new RecordOf(new LanguageTagRule)],
            'display.*' => ['required_with:display', 'string'],
            'description' => ['sometimes', ...new RecordOf(new LanguageTagRule)],
            'description.*' => ['required_with:description', 'string'],
            'contentType' => ['string'], // MIME type
            'length' => ['integer'],
            'sha2' => ['string'],
            'fileUrl' => ['string', 'url'],
        ];
    }
}
