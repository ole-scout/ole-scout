<?php

namespace FossHaas\Consent\Models;

use FossHaas\Consent\Enums\CookieType;
use FossHaas\Consent\Enums\LegalBasis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ServiceCookie extends Model
{
    use HasFactory, HasTranslations;

    protected $attributes = [
        'legal_basis' => LegalBasis::CONSENT,
    ];

    protected $fillable = [
        'type',
        'name',
        'host',
        'description',
        'duration',
        'legal_basis',
        'service_definition_id',
    ];

    protected $casts = [
        'type' => CookieType::class,
        'duration' => 'json',
        'legal_basis' => LegalBasis::class,
    ];

    public $translatable = [
        'description',
    ];

    public function serviceDefinition(): BelongsTo
    {
        return $this->belongsTo(ServiceDefinition::class);
    }
}
