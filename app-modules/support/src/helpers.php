<?php

namespace FossHaas\Support;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;

if (! function_exists('preciseDiffForHumans')) {
    /**
     * Get a millisecond-precision difference between two dates in a human readable format.
     * 
     * @param Carbon $startTime
     * @param Carbon|null $endTime defaults to now
     */
    function preciseDiffForHumans(Carbon $startTime, $endTime = null): string
    {
        return CarbonInterval::milliseconds((int) $startTime->diffInMilliseconds($endTime))
            ->cascade()
            ->forHumans(['minimumUnit' => 'ms']);
    }
}

if (! function_exists('getMorphFields')) {
    /**
     * Get the morph fields for a model.
     * 
     * @param Model $model
     * @param string $name name of the morph relation
     */
    function getMorphFields(Model $model, string $name): array
    {
        return [
            $name . '_id' => $model->id,
            $name . '_type' => $model->getMorphClass(),
        ];
    }
}
