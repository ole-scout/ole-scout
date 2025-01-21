<?php

namespace FossHaas\Identities\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property string $slug
 * @property array $name
 * @property string $type
 * @property array $config
 * @property bool $is_disabled
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int,AccountIdentity> $identities
 */
class IdentityProvider extends Model
{
    use HasFactory, HasTranslations;

    //#region Attributes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'name',
        'type',
        'config',
        'is_disabled',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'config',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'config' => 'json',
        ];
    }

    public array $translatable = ['name'];

    //#endregion

    //#region Relationships

    public function identities(): HasMany
    {
        return $this->hasMany(AccountIdentity::class);
    }

    //#endregion
}
