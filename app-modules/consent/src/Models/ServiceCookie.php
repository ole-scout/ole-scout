<?php

namespace FossHaas\Consent\Models;

use FossHaas\Consent\CookieType;
use FossHaas\Consent\LegalBasis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class ServiceCookie extends Model
{
    use HasFactory;

    protected $attributes = [
        'legalBasis' => LegalBasis::consent,
    ];

    protected $fillable = [
        'type',
        'name',
        'duration',
        'legalBasis',
        'service_definition_id',
    ];

    protected $casts = [
        'type' => CookieType::class,
        'duration' => 'json',
        'legalBasis' => LegalBasis::class,
    ];

    public function content(): string|null
    {
        return $this->locale()?->content;
    }

    public function purpose(): string|null
    {
        return $this->locale()?->purpose;
    }

    public function locale(?string $locale = null): ?ServiceCookieLocale
    {
        if (!$locale) {
            return (
                $this->locale(App::currentLocale())
                ?: $this->locale(App::getFallbackLocale())
                ?: $this->serviceCookieLocales()->first()
                ?: null
            );
        }
        return $this->serviceCookieLocales()
            ->where('locale', $locale)
            ->first();
    }

    public function serviceCookieLocales(): HasMany
    {
        return $this->hasMany(ServiceCookieLocale::class);
    }

    public function serviceDefinition(): BelongsTo
    {
        return $this->belongsTo(ServiceDefinition::class);
    }
}
