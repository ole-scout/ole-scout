<?php

namespace FossHaas\Courses\Models;

use FossHaas\Courses\Actions\CreateVisibleCourseGroups;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class CourseGroup extends Model
{
    use HasFactory, HasRecursiveRelationships;

    protected static function booted()
    {
        static::updated(function (CourseGroup $group) {
            if ($group->wasChanged('parent_id')) {
                app(CreateVisibleCourseGroups::class)->handle(
                    $group->enrollments()->get(),
                    prune: true
                );
            }
        });
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function courseGroups(): HasMany
    {
        return $this->hasMany(CourseGroup::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(CourseGroup::class);
    }

    public function visibleCourseGroups(): HasMany
    {
        return $this->hasMany(VisibleCourseGroup::class);
    }

    public function enrollments(): BelongsToMany
    {
        return $this->belongsToMany(Enrollment::class, VisibleCourseGroup::class);
    }
}
