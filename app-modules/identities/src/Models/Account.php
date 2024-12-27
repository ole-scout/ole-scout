<?php

namespace FossHaas\Identities\Models;

use FossHaas\LaravelPermissionObjects\AsPermissions;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    use HasTimestamps;

    protected $casts = [
        'permissions' => AsPermissions::class,
    ];

    //
}
