<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use FossHaas\Courses\Actions\CreateUserVisibleCourseGroups;
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
            app(CreateUserVisibleCourseGroups::class)->handle(
                collect([$enrollment])
            );
        });
    }

    protected $fillable = [
        'user_id',
        'course_id',
        'expires_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function userVisibleCourseGroups(): HasMany
    {
        return $this->hasMany(UserVisibleCourseGroup::class);
    }
}
