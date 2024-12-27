<?php

namespace FossHaas\Identities\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountIdentity extends Model
{
    use HasFactory;
    use HasTimestamps;

    protected $casts = [
        'profile_data' => 'json',
        'credentials' => 'json',
    ];
}
