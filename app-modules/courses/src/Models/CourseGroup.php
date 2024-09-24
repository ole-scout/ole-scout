<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use FossHaas\Courses\Actions\CreateCommonVisibleCourseGroups;
use FossHaas\Courses\Actions\CreateUserVisibleCourseGroups;
use FossHaas\Courses\Enums\Access;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class CourseGroup extends Model implements Sortable
{
    use HasFactory, HasRecursiveRelationships, HasTranslations, SortableTrait;

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function booted()
    {
        static::creating(function (CourseGroup $group) {
            $group->id = Str::uuid();
        });
        static::updated(function (CourseGroup $group) {
            if ($group->wasChanged('parent_id')) {
                app(CreateCommonVisibleCourseGroups::class)->handle(
                    $group->descendantsAndSelf()->get()->flatMap(
                        fn($group) => $group->publishedCourses()
                            ->where('access', '!=', Access::HIDDEN)
                            ->get()
                    ),
                    purge: true
                );
                app(CreateUserVisibleCourseGroups::class)->handle(
                    $group->enrollments()->get(),
                    purge: true
                );
            }
        });
    }

    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'icon',
        'color',
    ];

    public $translatable = [
        'title',
    ];

    public function buildSortQuery()
    {
        return static::query()->where([
            'parent_id' => $this->parent_id,
        ]);
    }

    public function scopeRoot(Builder $query): void
    {
        $query->whereNull('parent_id');
    }

    public function scopeForUser(Builder $query, ?User $user = null): void
    {
        if (!$user) $user = Auth::user();
        $query->whereHas('commonVisibleCourseGroups');
        if ($user) {
            $query->orWhereHas(
                'userVisibleCourseGroups',
                function (Builder $query) use ($user) {
                    $query->forUser($user);
                }
            );
        }
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function courseGroups(): HasMany
    {
        return $this->hasMany(CourseGroup::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(CourseGroup::class);
    }

    public function commonVisibleCourseGroups(): HasMany
    {
        return $this->hasMany(CommonVisibleCourseGroup::class);
    }

    public function userVisibleCourseGroups(): HasMany
    {
        return $this->hasMany(UserVisibleCourseGroup::class);
    }

    public function isVisible(?User $user = null)
    {
        if (!$user) $user = Auth::user();
        if ($this->commonVisibleCourseGroups()->exists()) return true;
        if (!$user) return false;
        return $this->userVisibleCourseGroups()->forUser($user)->exists();
    }
}
