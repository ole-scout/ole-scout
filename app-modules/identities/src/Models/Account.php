<?php

namespace FossHaas\Identities\Models;

use App\Models\User;
use FossHaas\LaravelPermissionObjects\AsPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * @property int $id
 * @property string|null $password
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property AsPermissions|null $permissions
 * @property bool $is_super_admin
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int,AccountIdentity> $identities
 * @property-read \Illuminate\Database\Eloquent\Collection<int,Persona> $personas
 */
class Account extends Model
{
    use Authorizable, HasFactory;

    //#region Attributes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'username',
        'password',
        'email',
        'email_verified_at',
        'permissions',
        'is_super_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'permissions',
        'is_super_admin',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'permissions' => AsPermissions::class,
            'is_super_admin' => 'boolean',
        ];
    }

    //#endregion

    //#region Relationships

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function identities(): HasMany
    {
        return $this->hasMany(AccountIdentity::class);
    }

    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class);
    }

    //#endregion
}
