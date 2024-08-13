<?php

namespace FossHaas\Consent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceCookieLocale extends Model
{
    use HasFactory;

    protected $fillable = [
        'locale',
        'content',
        'purpose',
    ];

    public function serviceCookie(): BelongsTo
    {
        return $this->belongsTo(ServiceCookie::class);
    }
}
