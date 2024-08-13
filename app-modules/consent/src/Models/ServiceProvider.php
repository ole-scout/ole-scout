<?php

namespace FossHaas\Consent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    public function email(): string|null
    {
        return $this->locale()?->email;
    }

    public function phone(): string|null
    {
        return $this->locale()?->phone;
    }

    public function privacy_policy(): string|null
    {
        return $this->locale()?->privacy_policy;
    }

    public function imprint(): string|null
    {
        return $this->locale()?->imprint;
    }

    public function contact(): string|null
    {
        return $this->locale()?->contact;
    }

    public function locale(?string $locale = null): ?ServiceProviderLocale
    {
        if (!$locale) {
            return (
                $this->locale(App::currentLocale())
                ?: $this->locale(App::getFallbackLocale())
                ?: $this->serviceProviderLocales()->first()
                ?: null
            );
        }
        return $this->serviceProviderLocales()
            ->where('locale', $locale)
            ->first();
    }

    public function serviceProviderLocales(): HasMany
    {
        return $this->hasMany(ServiceProviderLocale::class);
    }

    public function serviceDefinition(): HasMany
    {
        return $this->hasMany(ServiceDefinition::class);
    }
}
