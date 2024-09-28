<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityState extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'activity_id',
        'content_state',
        'completed_at',
    ];

    protected $casts = [
        'content_state' => AsArrayObject::class,
    ];

    protected static function booted()
    {
        static::updated(function (ActivityState $activityState) {
            if ($activityState->wasChanged('completed_at')) {
                $courseState = $activityState->course->states()
                    ->where('user_id', $activityState->user_id)
                    ->first();
                $activityStates = $courseState->activityState()
                    ->select(['activity_id', 'completed_at'])
                    ->get();
                $numTotal = $activityStates->count();
                $numCompleted = $activityStates
                    ->where('completed_at', '!==', null)
                    ->count();
                $courseState->percent_completed = (int) round(
                    ($numCompleted / $numTotal) * 100
                );
                if (
                    $courseState->completed_at === null
                    && $activityState->activity->is_required
                ) {
                    $requiredActivities = $courseState->activities()
                        ->where('is_required', true)
                        ->select(['id'])
                        ->pluck('id');
                    $requiredCompleted = $activityStates
                        ->whereIn('activity_id', $requiredActivities)
                        ->where('completed_at', '!==', null)
                        ->count();
                    if ($requiredCompleted === $requiredActivities->count()) {
                        $courseState->completed_at = now();
                    }
                }
                $courseState->save();
            }
        });
    }

    public function scopeForUser(Builder $query, ?User $user = null): void
    {
        if (!$user) $user = Auth::user();
        if (!$user) $query->where(false);
        else $query->where('user_id', $user->id);
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
