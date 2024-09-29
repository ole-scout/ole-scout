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
            if (
                $activityState->wasChanged('completed_at') &&
                $activityState->completed_at !== null
            ) {
                $courseState = $activityState->course->states()
                    ->where('user_id', $activityState->user_id)
                    ->first();
                if ($activityState->activity->is_required) {
                    if (++$courseState->progress['required_completed'] === $courseState->progress['required_total']) {
                        $courseState->completed_at = now();
                    }
                } else {
                    $courseState->progress['optional_completed']++;
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
