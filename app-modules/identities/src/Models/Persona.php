<?php

namespace FossHaas\Identities\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string|null $org
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Account $account
 * @property-read \Illuminate\Database\Eloquent\Collection<int,User> $users
 */
class Persona extends Model
{
    use HasFactory;

    //#region Attributes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'account_id',
        'first_name',
        'last_name',
        'org',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }

    //#endregion

    //#region Relationships

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    //#endregion
}
