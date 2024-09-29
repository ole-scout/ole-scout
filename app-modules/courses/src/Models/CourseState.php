<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class CourseState extends Model
{
    protected $attributes = [
        'progress' => '{"required_total":0,"required_completed":0,"optional_total":0,"optional_completed":0}',
        'completed_at' => null,
    ];

    protected $casts = [
        'progress' => AsArrayObject::class,
    ];

    protected static function booted()
    {
        static::creating(function (CourseState $state) {
            if ($state->course_id) {
                $state->progress['required_total'] = 0;
                $state->progress['required_completed'] = 0;
                $state->progress['optional_total'] = 0;
                $state->progress['optional_completed'] = 0;
                foreach ($state->course->activities as $activity) {
                    $activityState = $activity->states()->firstOrCreate([
                        'user_id' => $state->user_id,
                        'course_id' => $state->course_id,
                        'activity_id' => $activity->id,
                    ]);
                    if ($activity->is_required) {
                        $state->progress['required_total']++;
                        if ($activityState->completed_at !== null) {
                            $state->progress['required_completed']++;
                        }
                    } else {
                        $state->progress['optional_total']++;
                        if ($activityState->completed_at !== null) {
                            $state->progress['optional_completed']++;
                        }
                    }
                }
            }
        });
    }

    public function scopeForUser(Builder $query, ?User $user = null): void
    {
        if (!$user) $user = Auth::user();
        if (!$user) $query->where(false);
        else $query->where('user_id', $user->id);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
