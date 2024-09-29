<?php

namespace FossHaas\Courses\Models;

use App\Models\User;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Enrollment extends Model
{
    use HasTimestamps;

    protected $fillable = [
        'user_id',
        'course_id',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::addGlobalScope('active', function (Builder $query): void {
            $query
                ->whereNull('expires_at')
                ->orWhere('expires_at', '>', now());
        });
    }

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

    public function getExpirationForHumansAttribute(): string|null
    {
        if ($this->expires_at === null || $this->expires_at->isPast()) {
            return null;
        }
        $interval = CarbonInterval::diff($this->expires_at, now());
        $nonZero = $interval->getNonZeroValues();
        $diff = $interval->forHumans(parts: 1);
        $key = array_keys($nonZero)[0];
        $value = $nonZero[$key];
        return trans_choice(':diff remaining', $value, ['diff' => $diff]);
    }
}
