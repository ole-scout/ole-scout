<?php

namespace FossHaas\Lrs\Rules;

use FossHaas\Lrs\Enums\InteractionType;
use FossHaas\Validation\ArrayValidationRule;
use FossHaas\Validation\Rules\ListOf;
use FossHaas\Validation\Rules\RecordOf;
use Illuminate\Validation\Rules\Enum;

class ActivityDefinition extends ArrayValidationRule
{
    public function __construct()
    {
        $this->rules = [
            'name' => ['sometimes', ...new RecordOf(new LanguageTagRule)],
            'name.*' => ['required_with:name', 'string'],
            'description' => ['sometimes', ...new RecordOf(new LanguageTagRule)],
            'description.*' => ['required_with:description', 'string'],
            'type' => ['string', 'url'],
            'moreInfo' => ['string', 'url'],
            'interactionType' => ['string', new Enum(InteractionType::class)],
            'correctResponsesPattern' => ['sometimes', ...new ListOf('string')],
            'choices' => ['sometimes', 'required_if:interactionType,choice,sequencing', ...new ListOf(...new InteractionComponent)],
            'scale' => ['sometimes', 'required_if:interactionType,likert', ...new ListOf(...new InteractionComponent)],
            'source' => ['sometimes', 'required_if:interactionType,matching', ...new ListOf(...new InteractionComponent)],
            'target' => ['sometimes', 'required_if:interactionType,matching', ...new ListOf(...new InteractionComponent)],
            'steps' => ['sometimes', 'required_if:interactionType,performance', ...new ListOf(...new InteractionComponent)],
            'extensions' => ['sometimes', ...new RecordOf('string', 'url')],
        ];
    }
}
