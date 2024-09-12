<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserVisibleCourseGroup extends Model
{
    protected static function booted()
    {
        static::creating(function (UserVisibleCourseGroup $group) {
            if (is_null($group->user_id) && !is_null($group->enrollment_id)) {
                $group->user_id = $group->enrollment->user_id;
            }
        });
    }

    protected $fillable = [
        'user_id',
        'course_group_id',
        'enrollment_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
