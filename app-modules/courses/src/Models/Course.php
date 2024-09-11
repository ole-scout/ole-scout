<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use FossHaas\Courses\Actions\CreateCommonVisibleCourseGroups;
use FossHaas\Courses\Actions\CreateUserVisibleCourseGroups;
use FossHaas\Courses\Enums\Access;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Course extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function booted()
    {
        static::creating(function (Course $course) {
            $course->id = Str::uuid();
        });
        static::created(function (Course $course) {
            app(CreateCommonVisibleCourseGroups::class)->handle(
                collect([$course])
            );
        });
        static::updated(function (Course $course) {
            if ($course->wasChanged(['parent_id', 'access'])) {
                app(CreateCommonVisibleCourseGroups::class)->handle(
                    collect([$course]),
                    purge: true
                );
                if ($course->wasChanged('parent_id')) {
                    app(CreateUserVisibleCourseGroups::class)->handle(
                        $course->enrollments()->get(),
                        purge: true
                    );
                }
            }
        });
    }

    protected $fillable = [
        'course_group_id',
        'language',
        'slug',
        'title',
        'description',
        'icon',
        'color',
        'author',
        'clearance',
        'icon',
        'is_published',
        'access',
        'cert',
    ];

    protected $casts = [
        'access' => Access::class,
        'cert' => 'json',
    ];

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

    public function commonVisibleCourseGroups(): HasMany
    {
        return $this->hasMany(CommonVisibleCourseGroup::class);
    }
}
