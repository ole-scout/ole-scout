<?php

namespace FossHaas\Lrs\Actions;

use FossHaas\Lrs\Models\XapiActivity;

class GetActivity
{
    public function handle(string $activityId): array
    {
        // TODO headers?
        $activity = XapiActivity::find($activityId);

        if (! $activity) {
            return ['id' => $activityId];
        }

        return [
            'id' => $activity->id,
            'definition' => $activity->definition,
        ];
    }
}
