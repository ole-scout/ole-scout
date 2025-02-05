<?php

namespace FossHaas\Lrs\Actions;

use FossHaas\Lrs\Enums\InverseFunctionalIdentifier;
use FossHaas\Lrs\Enums\XapiAgentRelationship;
use FossHaas\Lrs\Enums\XapiGroupRelationship;
use FossHaas\Lrs\Enums\XapiStatementRelationship;
use FossHaas\Lrs\Models\XapiActivity;
use FossHaas\Lrs\Models\XapiAgent;
use FossHaas\Lrs\Models\XapiGroup;
use FossHaas\Lrs\Models\XapiStatement;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreStatement
{
    public function handle(array $data): XapiStatement
    {
        // TODO headers?
        ray()->showQueries();
        $XAPI_VOIDED = 'http://adlnet.gov/expapi/verbs/voided';
        $parsed = app(ParseStatement::class)->handle($data);

        $statement = DB::transaction(function () use ($parsed, $XAPI_VOIDED) {
            $data = $parsed['statement'];

            $timestamp = now();
            $data['stored'] = $timestamp
                ->toIso8601ZuluString('millisecond');
            if (isset($data['timestamp'])) {
                $timestamp = Carbon::parse($data['timestamp']);
                $data['timestamp'] = $timestamp
                    ->toIso8601ZuluString('millisecond');
            } else {
                $data['timestamp'] = $data['stored'];
            }

            if (! isset($data['id'])) {
                $data['id'] = Str::uuid();
            }

            /** @var XapiStatement $statement */
            $statement = XapiStatement::create([
                'id' => $data['id'],
                'parsed_json' => &$data,
                'registration' => $data['registration'] ?? null,
                'verb_id' => $data['verb']['id'],
                'timestamp' => $timestamp,
                'voided_by' => null,
            ]);

            if ($statement->verb_id !== $XAPI_VOIDED) {
                $voidingStatement = $statement->relatingStatements()
                    ->wherePivot('relationship', XapiStatementRelationship::OBJECT->value)
                    ->where('verb_id', $XAPI_VOIDED)
                    ->first();
                if ($voidingStatement) {
                    $statement->voided_by = $voidingStatement->id;
                    $statement->save();
                }
            }

            return $statement;
        });

        foreach ($parsed['agents'] as ['relationship' => $relationship, 'data' => $data]) {
            [$ifi_type, $ifi_value] = InverseFunctionalIdentifier::fromData($data)[0];
            /** @var XapiAgent $agent */
            $agent = XapiAgent::firstOrCreate(
                ['ifi_type' => $ifi_type, 'ifi_value' => $ifi_value],
                Arr::except($data, ['objectType', ...InverseFunctionalIdentifier::values()]),
            );
            if (! $agent->name && isset($data['name'])) {
                $agent->name = $data['name'];
                $agent->save();
            }
            $statement->relatedAgents()->attach($agent->id, [
                'relationship' => $relationship->value,
            ]);
        }

        $modifiedGroups = [];
        foreach ($parsed['groups'] as ['relationship' => $relationship, 'data' => $data, 'members' => $members]) {
            [$ifi_type, $ifi_value] = InverseFunctionalIdentifier::fromData($data)[0];
            /** @var XapiGroup $group */
            $group = XapiGroup::firstOrCreate(
                ['ifi_type' => $ifi_type, 'ifi_value' => $ifi_value],
                Arr::only($data, ['name']),
            );
            if (! $group->name && isset($data['name'])) {
                $group->name = $data['name'];
                $group->save();
            }
            $statement->relatedGroups()->attach($group->id, [
                'relationship' => $relationship->value,
            ]);
            if (! isset($modifiedGroups[$group->id])) {
                $modifiedGroups[$group->id] = $group;
            }
            foreach ($members as $data) {
                [$ifi_type, $ifi_value] = InverseFunctionalIdentifier::fromData($data)[0];
                /** @var XapiAgent $agent */
                $agent = XapiAgent::firstOrCreate(
                    ['ifi_type' => $ifi_type, 'ifi_value' => $ifi_value],
                    Arr::only($data, ['name']),
                );
                if (! $agent->name && isset($data['name'])) {
                    $agent->name = $data['name'];
                    $agent->save();
                }
                $group->members()->attach($agent->id);
            }
        }

        foreach ($modifiedGroups as $group) {
            foreach ($group->relatedStatements as $relatedStatement) {
                foreach ($group->members as $agent) {
                    $relatedStatement->relatedAgents()->attach($agent->id, [
                        'relationship' => XapiAgentRelationship::member(
                            XapiGroupRelationship::from(
                                $relatedStatement->pivot->relationship
                            )
                        )->value,
                    ]);
                }
            }
        }

        foreach ($parsed['activities'] as ['relationship' => $relationship, 'data' => $data]) {
            /** @var XapiActivity $activity */
            $activity = XapiActivity::firstOrCreate(
                Arr::only($data, ['id']),
                Arr::only($data, ['definition']),
            );
            if ($activity->wasRecentlyCreated) {
                // TODO: Sync definition from $activity->id if the value is a valid URL
            }
            $statement->relatedActivities()->attach($activity->id, [
                'relationship' => $relationship->value,
            ]);
        }

        foreach ($parsed['refs'] as ['relationship' => $relationship, 'data' => $data]) {
            $statement->relatedStatements()->attach($data['id'], [
                'relationship' => $relationship->value,
            ]);
            if ($relationship === XapiStatementRelationship::OBJECT && $statement->verb_id === $XAPI_VOIDED) {
                $object = XapiStatement::find($data['id']);
                if ($object && ! isset($object->voided_by) && $object->verb_id !== $XAPI_VOIDED) {
                    $object->voided_by = $statement->id;
                    $object->save();
                }
            }
        }

        return $statement;
    }
}
