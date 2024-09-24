<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\HasManyOfDescendants;

class CourseGroup extends Model implements Sortable
{
    use HasFactory, HasRecursiveRelationships, HasTranslations, SoftDeletes, SortableTrait;

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function booted()
    {
        static::creating(function (CourseGroup $group) {
            $group->id = Str::uuid();
            if ($group->parent_id) {
                $root = $group->parent->ancestorsAndSelf()
                    ->depthFirst()
                    ->whereNull('parent_id')
                    ->first();
                $group->path = $root->traversal_slug_path_reverse . '/' . $group->slug;
            } else {
                $group->path = $group->slug;
            }
        });
        static::updating(function (CourseGroup $group) {
            if ($group->wasChanged('parent_id')) {
                if ($group->parent_id) {
                    $root = $group->parent->ancestorsAndSelf()
                        ->depthFirst()
                        ->whereNull('parent_id')
                        ->first();
                    $group->path = $root->traversal_slug_path_reverse . '/' . $group->slug;
                } else {
                    $group->path = $group->slug;
                }
            } else if ($group->wasChanged('slug')) {
                $i = strrpos($group->path, '/');
                if ($i === false) {
                    $group->path = $group->slug;
                } else {
                    $group->path = substr($group->path, 0, $i) . '/' . $group->slug;
                }
            }
        });
        static::deleting(function (CourseGroup $group) {
            $children = $group->courseGroups;
            foreach ($children as $child) {
                $child->slug = strtr($group->path, ['/' => '-']) . '-' . $child->slug;
                $child->parent_id = null;
                $child->save();
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

    public function getPathName()
    {
        return 'traversal_path';
    }

    public function getCustomPaths()
    {
        return [
            [
                'name' => 'traversal_slug_path',
                'column' => 'slug',
                'separator' => '/',
            ],
            [
                'name' => 'traversal_slug_path_reverse',
                'column' => 'slug',
                'separator' => '/',
                'reverse' => true,
            ],
            [
                'name' => $this->getPathName() . '_reverse',
                'column' => $this->getKeyName(),
                'separator' => $this->getPathSeparator(),
                'reverse' => true,
            ],
        ];
    }

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
        $query->whereHas('recursiveCourses', function (Builder $query) use ($user) {
            Course::filterForUser($query, $user);
        });
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

    public function recursiveCourses(): HasManyOfDescendants
    {
        return $this->hasManyOfDescendantsAndSelf(Course::class);
    }

    public function isVisible(?User $user = null)
    {
        if (!$user) $user = Auth::user();
        $query = $this->recursiveCourses();
        Course::filterForUser($query, $user);
        return $query->exists();
    }
}
