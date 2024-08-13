<?php

namespace FossHaas\Consent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceProviderLocale extends Model
{
    use HasFactory;

    protected $fillable = [
        'locale',
        'email',
        'phone',
        'privacy_policy',
        'imprint',
        'contact',
    ];

    public function serviceProvider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
