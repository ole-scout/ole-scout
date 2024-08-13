<?php

namespace FossHaas\Consent\Models;

use FossHaas\Consent\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class ServiceDefinition extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'service_provider_id',
    ];

    protected $casts = [
        'category' => Category::class,
    ];

    public function name(): string|null
    {
        return $this->locale()?->name;
    }

    public function description(): string|null
    {
        return $this->locale()?->description;
    }

    public function locale(?string $locale = null): ?ServiceDefinitionLocale
    {
        if (!$locale) {
            return (
                $this->locale(App::currentLocale())
                ?: $this->locale(App::getFallbackLocale())
                ?: $this->serviceDefinitionLocales()->first()
                ?: null
            );
        }
        return $this->serviceDefinitionLocales()
            ->where('locale', $locale)
            ->first();
    }

    public function serviceDefinitionLocales(): HasMany
    {
        return $this->hasMany(ServiceDefinitionLocale::class);
    }

    public function serviceProvider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function serviceCookies(): HasMany
    {
        return $this->hasMany(ServiceCookie::class);
    }
}
