<?php

namespace FossHaas\Lrs\Actions;

use FossHaas\Lrs\Models\XapiAgent;

class GetAgent
{
    public function handle(array $ifi): array
    {
        // TODO headers?
        $data = [
            'name' => [],
            'mbox' => [],
            'mbox_sha1sum' => [],
            'openid' => [],
            'account' => [],
        ];

        $agents = XapiAgent::whereIfi($ifi)->get();

        if ($agents->count() === 0) {
            foreach ($ifi as $key => $value) {
                $data[$key][] = $value;
            }

            return $data;
        }

        foreach ($agents as $agent) {
            if (isset($agent->name) && ! in_array($agent->name, $data['name'])) {
                $data['name'][] = $agent->name;
            }
            if (! in_array($agent->ifi_value, $data[$agent->ifi_type->value])) {
                $data[$agent->ifi_type->value][] = $agent->ifi_value;
            }
        }

        $data['account'] = array_map(function ($account) {
            $parsed = json_decode($account, true);

            return [
                'homePage' => $parsed['homePage'],
                'name' => $parsed['name'],
            ];
        }, $data['account']);

        return $data;
    }
}
