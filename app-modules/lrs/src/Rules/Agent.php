<?php

namespace FossHaas\Lrs\Rules;

use FossHaas\Validation\ArrayValidationRule;
use FossHaas\Validation\Rules\ArrayRule;

class Agent extends ArrayValidationRule
{
    public function __construct()
    {
        $this->rules = [
            'objectType' => ['string', 'in:Agent'],
            'name' => ['string'],
            'mbox' => ['string', 'starts_with:mailto:', 'required_without_all:mbox_sha1sum,openid,account', 'prohibits:openid,mbox_sha1sum,account'],
            'mbox_sha1sum' => ['string', 'required_without_all:mbox,openid,account', 'prohibits:openid,mbox,account'],
            'openid' => ['string', 'url', 'required_without_all:mbox,mbox_sha1sum,account', 'prohibits:mbox,mbox_sha1sum,account'],
            'account' => ['required_without_all:mbox,mbox_sha1sum,openid', 'prohibits:mbox,mbox_sha1sum,openid', ...new ArrayRule([
                'homePage' => ['required_with:account', 'string', 'url'],
                'name' => ['required_with:account', 'string'],
            ])],
        ];
    }
}
