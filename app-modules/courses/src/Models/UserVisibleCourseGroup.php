<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserVisibleCourseGroup extends Model
{
    protected $fillable = [
        'course_group_id',
        'enrollment_id',
    ];

    public function scopeForUser(Builder $query, ?User $user): void
    {
        $query->whereHas(
            'enrollment',
            function (Builder $query) use ($user) {
                $query->forUser($user);
            }
        );
    }

    public function courseGroup(): BelongsTo
    {
        return $this->belongsTo(CourseGroup::class);
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }
}
