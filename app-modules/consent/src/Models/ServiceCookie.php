<?php

namespace FossHaas\Consent\Models;

use FossHaas\Consent\CookieType;
use FossHaas\Consent\LegalBasis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ServiceCookie extends Model
{
    use HasFactory, HasTranslations;

    protected $attributes = [
        'legalBasis' => LegalBasis::consent,
    ];

    protected $fillable = [
        'type',
        'name',
        'content',
        'purpose',
        'duration',
        'legalBasis',
        'service_definition_id',
    ];

    protected $casts = [
        'type' => CookieType::class,
        'duration' => 'json',
        'legalBasis' => LegalBasis::class,
    ];

    public $translatable = [
        'content',
        'purpose',
    ];

    public function serviceDefinition(): BelongsTo
    {
        return $this->belongsTo(ServiceDefinition::class);
    }
}
