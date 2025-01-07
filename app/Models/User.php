<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use FossHaas\Identities\Models\Account;
use FossHaas\Identities\Models\Persona;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read Account $account
 * @property-read Persona|null $persona
 * @property-read \Illuminate\Database\Eloquent\Collection<int,Session> $sessions
 * @property-read int|null $sessions_count
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    //#region Attributes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

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

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    //#endregion

    //#region Authorizable

    public function can($abilities, $arguments = [])
    {
        return $this->account->can($abilities, $arguments);
    }

    public function canAny($abilities, $arguments = [])
    {
        return $this->account->canAny($abilities, $arguments);
    }

    //#endregion

    //#region CanResetPassword

    public function getEmailForPasswordReset(): string
    {
        return $this->account->email;
    }

    //#endregion

    //#region MustVerifyEmail

    public function hasVerifiedEmail(): bool
    {
        return ! is_null($this->account->email_verified_at);
    }

    public function markEmailAsVerified(): bool
    {
        return $this->account->forceFill([
            'email_verified_at' => $this->account->freshTimestamp(),
        ])->save();
    }

    public function getEmailForVerification(): string
    {
        return $this->account->email;
    }

    //#endregion
}
