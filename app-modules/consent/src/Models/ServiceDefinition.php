<?php

namespace FossHaas\Consent\Models;

use FossHaas\Consent\Enums\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class ServiceDefinition extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'category',
        'name',
        'description',
        'service_provider_id',
    ];

    protected $casts = [
        'category' => Category::class,
    ];

    public $translatable = [
        'name',
        'description',
    ];

    public function serviceProvider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function serviceCookies(): HasMany
    {
        return $this->hasMany(ServiceCookie::class);
    }
}
