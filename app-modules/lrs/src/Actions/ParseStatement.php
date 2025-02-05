<?php

namespace FossHaas\Lrs\Actions;

use FossHaas\Lrs\Enums\InverseFunctionalIdentifier;
use FossHaas\Lrs\Enums\XapiActivityRelationship;
use FossHaas\Lrs\Enums\XapiAgentRelationship;
use FossHaas\Lrs\Enums\XapiGroupRelationship;
use FossHaas\Lrs\Enums\XapiStatementRelationship;
use FossHaas\Lrs\Rules\Statement;
use Illuminate\Support\Carbon;

class ParseStatement
{
    /**
     * @return array{statement:array,agents:list<array>,groups:list<array>,activities:list<array>,refs:list<array>}
     */
    public function handle(array $data): array
    {
        $validated = validator(['statement' => $data], ['statement' => new Statement])
            ->validate();

        $parsed = [
            'statement' => &$validated['statement'],
            'agents' => [],
            'groups' => [],
            'activities' => [],
            'refs' => [],
        ];

        $this->parseStatement($validated['statement'], $parsed, false);

        return $parsed;
    }

    protected function parseObject(array &$object, string $relation, string $defaultObjectType, array &$parsed, bool $isSub = false): void
    {
        if ($isSub) {
            $relation = "sub_{$relation}";
        }
        switch ($object['objectType'] ?? $defaultObjectType) {
            case 'Agent':
                $relationship = XapiAgentRelationship::from($relation);
                $parsed['agents'][] = [
                    'relationship' => $relationship,
                    'data' => $object,
                ];
                break;
            case 'Group':
                $relationship = XapiGroupRelationship::from($relation);
                $isAnonymous = ! array_any(InverseFunctionalIdentifier::values(), fn ($key) => isset($object[$key]));
                $members = [];
                if (! $isAnonymous) {
                    $parsed['groups'][] = [
                        'relationship' => $relationship,
                        'data' => $object,
                        'members' => &$members,
                    ];
                }
                if (isset($object['member'])) {
                    foreach ($object['member'] as &$member) {
                        if ($isAnonymous) {
                            $parsed['agents'] = [
                                'relationship' => XapiAgentRelationship::member($relationship),
                                'data' => $member,
                            ];
                        } else {
                            $members[] = $member;
                        }
                    }
                }
                break;
            case 'Activity':
                $relationship = XapiActivityRelationship::from($relation);
                $parsed['activities'][] = [
                    'relationship' => $relationship,
                    'data' => $object,
                ];
                break;
            case 'StatementRef':
                $relationship = XapiStatementRelationship::from($relation);
                $parsed['refs'][] = [
                    'relationship' => $relationship,
                    'data' => $object,
                ];
                break;
            case 'SubStatement':
                if (isset($object['timestamp'])) {
                    $object['timestamp'] = Carbon::parse($object['timestamp'])
                        ->toIso8601ZuluString('millisecond');
                }
                $this->parseStatement($object, $parsed, true);
                break;
        }
    }

    protected function parseStatement(array &$statement, array &$parsed, bool $isSub = false): void
    {
        foreach ([
            'actor' => 'Agent',
            'data' => 'Activity',
        ] as $relation => $objectType) {
            if (isset($statement[$relation])) {
                $this->parseObject($statement[$relation], $relation, $objectType, $parsed, $isSub);
            }
        }

        if (isset($statement['context'])) {
            $context = &$statement['context'];

            foreach ([
                'instructor' => ['instructor', 'Agent'],
                'team' => ['team', 'Group'],
                'statement' => ['context', 'StatementRef'],
            ] as $key => [$relation, $objectType]) {
                if (isset($context[$key])) {
                    $this->parseObject($context[$key], $relation, $objectType, $parsed, $isSub);
                }
            }

            if (isset($context['contextActivities'])) {
                $contextActivities = &$context['contextActivities'];
                foreach (array_keys($contextActivities) as $relation) {
                    if (array_is_list($contextActivities[$relation])) {
                        foreach ($contextActivities[$relation] as &$activity) {
                            $this->parseObject($activity, $relation, 'Activity', $parsed, $isSub);
                        }
                    } else {
                        $activity = &$contextActivities[$relation];
                        $this->parseObject($activity, $relation, 'Activity', $parsed, $isSub);
                    }
                }
            }
        }
    }
}
