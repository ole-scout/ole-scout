<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use FossHaas\Courses\Actions\CreateVisibleCourseGroups;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::updated(function (Course $course) {
            if ($course->wasChanged('parent_id')) {
                app(CreateVisibleCourseGroups::class)->handle(
                    $course->enrollments()->get(),
                    prune: true
                );
            }
        });
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function activityGroups(): HasMany
    {
        return $this->hasMany(ActivityGroup::class);
    }

    public function courseGroup(): BelongsTo
    {
        return $this->belongsTo(CourseGroup::class);
    }

    public function prereqs(): BelongsToMany
    {
        return $this->belongsToMany(
            static::class,
            'course_prereqs',
            'course_id',
            'prereq_id'
        );
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function enrolledUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, Enrollment::class);
    }
}
