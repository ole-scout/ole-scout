<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use FossHaas\LaravelPermissionObjects\ScopedPermissions;
use FossHaas\LaravelPermissionObjects\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasPermissions, HasTimestamps;

    protected $attributes = [
        'is_admin' => false,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'permissions' => ScopedPermissions::class,
        ];
    }

    /**
     * Check if the user can access the panel.
     *
     * @return bool
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Add your logic here to determine if the user can access the panel
        // For now, let's assume only admin can access the panel
        return $this->is_admin;
    }
}
