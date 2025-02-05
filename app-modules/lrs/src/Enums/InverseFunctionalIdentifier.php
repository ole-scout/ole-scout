<?php

namespace FossHaas\Lrs\Enums;

use Illuminate\Support\Arr;

enum InverseFunctionalIdentifier: string
{
    case MBOX = 'mbox';
    case MBOX_SHA1SUM = 'mbox_sha1sum';
    case OPENID = 'openid';
    case ACCOUNT = 'account';

    public static function values(): array
    {
        return Arr::map(self::cases(), fn (InverseFunctionalIdentifier $case) => $case->value);
    }

    public static function fromData(array $data): array
    {
        $ifis = [];
        foreach (self::cases() as $case) {
            if (isset($data[$case->value])) {
                $ifis[] = [$case->value, $case->serialize($data[$case->value])];
                if ($case === self::MBOX && ! isset($data[self::MBOX_SHA1SUM->value])) {
                    $ifis[] = [self::MBOX_SHA1SUM->value, self::MBOX_SHA1SUM->serialize(sha1($data[$case->value]))];
                }
            }
        }

        return $ifis;
    }

    public function serialize(mixed $value): string
    {
        switch ($this) {
            case self::ACCOUNT:
                return json_encode([
                    'homePage' => $value['homePage'] ?? null,
                    'name' => $value['name'] ?? null,
                ]);
            case self::MBOX:
                [$head, $tail] = explode('@', $value, 2);
                $tail = mb_strtolower($tail);

                return "{$head}@{$tail}";
            case self::MBOX_SHA1SUM:
                return mb_strtolower($value);
            default:
                return $value;
        }
    }
}
