<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class CourseState extends Model
{
    protected $attributes = [
        'percent_complete' => 0,
        'completed_at' => null,
    ];

    public function scopeForUser(Builder $query, ?User $user = null): void
    {
        if (!$user) $user = Auth::user();
        if (!$user) $query->where(false);
        else $query->where('user_id', $user->id);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function activityStates(): HasMany
    {
        return $this->hasMany(ActivityState::class);
    }
}
