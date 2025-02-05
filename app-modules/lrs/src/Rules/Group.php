<?php

namespace FossHaas\Lrs\Rules;

use FossHaas\Validation\ArrayValidationRule;
use FossHaas\Validation\Rules\ArrayRule;
use FossHaas\Validation\Rules\ListOf;

class Group extends ArrayValidationRule
{
    public function __construct()
    {
        $this->rules = [
            'objectType' => ['required', 'string', 'in:Group'],
            'name' => ['string'],
            'mbox' => ['string', 'starts_with:mailto:', 'prohibits:openid,mbox_sha1sum,account'],
            'mbox_sha1sum' => ['string', 'length:40', 'prohibits:openid,mbox,account'],
            'openid' => ['string', 'url', 'prohibits:mbox,mbox_sha1sum,account'],
            'account' => ['prohibits:mbox,mbox_sha1sum,openid', ...new ArrayRule([
                'homePage' => ['required_with:account', 'string', 'url'],
                'name' => ['required_with:account', 'string'],
            ])],
            'member' => ['required_without_all:mbox,mbox_sha1sum,openid,account', new ListOf('required_with:member', ...new Agent)],
        ];
    }
}
