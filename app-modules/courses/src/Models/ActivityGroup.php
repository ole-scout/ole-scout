<?php

namespace FossHaas\Courses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class ActivityGroup extends Model implements Sortable
{
    use HasFactory, HasRecursiveRelationships, SortableTrait;

    protected static function booted()
    {
        static::creating(function (ActivityGroup $group) {
            if (is_null($group->course_id) && !is_null($group->parent)) {
                $group->course_id = $group->parent->course_id;
            }
        });
    }

    protected $fillable = [
        'course_id',
        'parent_id',
        'slug',
    ];

    public function buildSortQuery()
    {
        return static::query()->where([
            'course_id' => $this->course_id,
            'parent_id' => $this->parent_id,
        ]);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function activityGroups(): HasMany
    {
        return $this->hasMany(ActivityGroup::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ActivityGroup::class);
    }
}
