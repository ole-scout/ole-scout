<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class CourseState extends Model
{
    use HasTimestamps;

    protected $attributes = [
        'activities' => '[]',
        'completed_at' => null,
    ];

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'activities' => AsArrayObject::class,
    ];

    protected function progress(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $activities = json_decode($attributes['activities'], true);
                return [
                    'required_total' => count(
                        array_filter(
                            $activities,
                            fn($activity) => $activity['is_required']
                        )
                    ),
                    'optional_total' => count(
                        array_filter(
                            $activities,
                            fn($activity) => !$activity['is_required']
                        )
                    ),
                    'required_completed' => count(
                        array_filter(
                            $activities,
                            fn($activity) => $activity['is_required'] && $activity['completed_at'] !== null
                        )
                    ),
                    'optional_completed' => count(
                        array_filter(
                            $activities,
                            fn($activity) => !$activity['is_required'] && $activity['completed_at'] !== null
                        )
                    ),
                ];
            }
        );
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
