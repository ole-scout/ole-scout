<?php

namespace FossHaas\Courses\Models;

use FossHaas\Support\CalVer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Activity extends Model implements Sortable
{
    use HasFactory, HasTimestamps, SoftDeletes, SortableTrait;

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function booted()
    {
        static::addGlobalScope('enabled', function (Builder $query): void {
            $query->where('is_disabled', false);
        });
        $calver = new CalVer(minorIsDay: true);
        static::creating(function (Activity $activity) use ($calver) {
            $activity->id = Str::uuid();
            $activity->version = $calver();
        });
        static::created(function (Activity $activity) {
            $content = $activity->content;
            $content->activity_id = $activity->id;
            $content->save();
        });
        static::updating(function (Activity $activity) use ($calver) {
            if (!$activity->isDirty()) return;
            $activity->version = $calver->increment($activity->version);
        });
    }

    public function buildSortQuery()
    {
        return static::query()->where([
            'course_id' => $this->course_id,
            'activity_group_id' => $this->activity_group_id,
        ]);
    }

    protected $fillable = [
        'course_id',
        'activity_group_id',
        'content_id',
        'content_type',
        'title',
        'description',
        'is_disabled',
        'is_required',
    ];

    public function scopeRoot(Builder $query): void
    {
        $query->whereNull('activity_group_id');
    }

    public function content(): MorphTo
    {
        return $this->morphTo();
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function activityGroup(): BelongsTo
    {
        return $this->belongsTo(ActivityGroup::class);
    }

    public function prereqs(): BelongsToMany
    {
        return $this->belongsToMany(
            static::class,
            'activity_prereqs',
            'activity_id',
            'prereq_id'
        );
    }
}
