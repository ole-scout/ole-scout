<?php

namespace FossHaas\Lrs\DataTransferObjects;

use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Prohibits;
use Spatie\LaravelData\Attributes\Validation\RequiredWithoutAll;
use Spatie\LaravelData\Attributes\Validation\StartsWith;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class Agent extends Data
{
    public function __construct(
        #[In('Agent')]
        public string|Optional $objectType,
        public string|Optional $name,
        #[RequiredWithoutAll(['mbox_sha1sum', 'openid', 'account'])]
        #[StartsWith('mailto:')]
        #[Prohibits(['openid', 'mbox_sha1sum', 'account'])]
        public string|Optional $mbox,
        #[RequiredWithoutAll(['mbox', 'openid', 'account'])]
        #[Prohibits(['openid', 'mbox', 'account'])]
        public string|Optional $mbox_sha1sum,
        #[RequiredWithoutAll(['mbox', 'mbox_sha1sum', 'account'])]
        #[Url]
        #[Prohibits(['mbox', 'mbox_sha1sum', 'account'])]
        public string|Optional $openid,
        #[RequiredWithoutAll(['mbox', 'mbox_sha1sum', 'openid'])]
        #[Prohibits(['mbox', 'mbox_sha1sum', 'openid'])]
        public Account|Optional $account,
    ) {}
}
