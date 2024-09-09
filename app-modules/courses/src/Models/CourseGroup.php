<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseGroup extends Model
{
    use HasFactory;

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
}
