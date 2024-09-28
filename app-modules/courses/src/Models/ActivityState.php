<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ActivityState extends Model
{
    protected static function booted()
    {
        static::updated(function (ActivityState $activityState) {
            if ($activityState->wasChanged('completed_at')) {
                $courseState = $activityState->course->states()
                    ->where('user_id', $activityState->user_id)
                    ->first();
                $activityStates = $courseState->activityState()
                    ->select(['completed_at'])
                    ->get();
                $total = $activityStates->count();
                $completed = $activityStates
                    ->filter(fn($state) => $state->completed_at !== null)
                    ->count();
                if ($completed === $total) {
                    $courseState->percent_completed = 100;
                    $courseState->completed_at = now();
                } else {
                    $courseState->percent_completed = (int) floor(
                        ($completed / $total) * 100
                    );
                }
                $courseState->save();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
