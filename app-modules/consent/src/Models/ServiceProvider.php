<?php

namespace FossHaas\Consent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class ServiceProvider extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'address',
    ];

    public $translatable = [
        'email',
        'phone',
        'privacy_policy',
        'imprint',
        'contact',
    ];

    public function serviceDefinition(): HasMany
    {
        return $this->hasMany(ServiceDefinition::class);
    }
}
