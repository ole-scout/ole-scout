<?php

namespace FossHaas\Courses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActivityGroup extends Model
{
    use HasFactory;

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
