<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use FossHaas\Courses\Actions\CreateVisibleCourseGroups;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollment extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function (Enrollment $enrollment) {
            app(CreateVisibleCourseGroups::class)->handle(
                collect([$enrollment])
            );
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function visibleCourseGroups(): HasMany
    {
        return $this->hasMany(VisibleCourseGroup::class);
    }
}
