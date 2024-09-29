<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use FossHaas\Courses\Enums\Access;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\HasManyOfDescendants;

class Course extends Model implements Sortable
{
    use HasFactory, HasTimestamps, SoftDeletes, SortableTrait;

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function booted()
    {
        static::addGlobalScope('published', function (Builder $query): void {
            $query->where('is_published', true);
        });
        static::creating(function (Course $course) {
            $course->id = Str::uuid();
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

    public function scopeRoot(Builder $query): void
    {
        $query->whereNull('course_group_id');
    }

    public function scopeForUser(Builder $query, ?User $user = null): void
    {
        if (!$user) $user = Auth::user();
        static::filterForUser($query, $user);
    }

    public static function filterForUser(Builder|Relation $query, ?User $user = null): void
    {
        $query->where('access', Access::OPEN);
        if ($user) {
            $query->orWhereHas(
                'enrollments',
                function (Builder $query) use ($user) {
                    $query->forUser($user);
                }
            );
        }
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class)->chaperone();
    }

    public function activityGroups(): HasMany
    {
        return $this->hasMany(ActivityGroup::class)->chaperone();
    }

    public function courseGroup(): BelongsTo
    {
        return $this->belongsTo(CourseGroup::class);
    }

    public function recursiveActivityGroups(): HasManyOfDescendants
    {
        return $this->hasManyOfDescendantsAndSelf(ActivityGroup::class);
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

    public function states(): HasMany
    {
        return $this->hasMany(CourseState::class);
    }
}
