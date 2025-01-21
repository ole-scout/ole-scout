<?php

namespace FossHaas\Identities\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $identifier
 * @property array|null $credentials
 * @property array|null $profile_data
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read Account $account
 * @property-read IdentityProvider $identityProvider
 */
class AccountIdentity extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope('enabled', function (Builder $builder) {
            $builder
                ->whereNot('profile_data->is_disabled', true)
                ->whereHas('identityProvider', function (Builder $query) {
                    $query->where('is_enabled', true);
                });
        });
    }

    //#region Attributes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'account_id',
        'identity_provider_id',
        'identifier',
        'credentials',
        'profile_data',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'credentials',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'profile_data' => 'json',
            'credentials' => 'json',
        ];
    }

    //#endregion

    //#region Scopes

    public function scopeProvidedBy(Builder $query, string $idpSlug): Builder
    {
        return $query->whereHas('identityProvider', function (Builder $query) use ($idpSlug) {
            $query->where('slug', $idpSlug);
        });
    }

    //#endregion

    //#region Relationships

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function identityProvider(): BelongsTo
    {
        return $this->belongsTo(IdentityProvider::class);
    }

    //#endregion
}
