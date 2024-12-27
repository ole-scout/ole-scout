<?php

namespace FossHaas\Identities\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class IdentityProvider extends Model
{
    use HasFactory;
    use HasTimestamps;
    use HasTranslations;

    protected $casts = [
        'config' => 'json',
    ];

    public array $translatable = ['name'];
}
