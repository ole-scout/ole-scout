<?php

namespace FossHaas\Lrs\DataTransferObjects;

use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Prohibits;
use Spatie\LaravelData\Attributes\Validation\RequiredWithoutAll;
use Spatie\LaravelData\Attributes\Validation\StartsWith;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class Group extends Data
{
    public function __construct(
        #[In('Group')]
        public string $objectType,
        public string|Optional $name,
        #[StartsWith('mailto:')]
        #[Prohibits(['openid', 'mbox_sha1sum', 'account'])]
        public string|Optional $mbox,
        #[Prohibits(['openid', 'mbox', 'account'])]
        public string|Optional $mbox_sha1sum,
        #[Url]
        #[Prohibits(['mbox', 'mbox_sha1sum', 'account'])]
        public string|Optional $openid,
        #[Prohibits(['mbox', 'mbox_sha1sum', 'openid'])]
        public Account|Optional $account,
        /** @var list<Agent> */
        #[RequiredWithoutAll(['mbox', 'mbox_sha1sum', 'openid', 'account'])]
        public array|Optional $member,
    ) {}
}
