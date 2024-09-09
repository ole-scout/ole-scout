<?php

namespace FossHaas\Courses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class CourseGroup extends Model
{
    use HasFactory, HasRecursiveRelationships;

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
