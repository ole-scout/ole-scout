<?php

namespace FossHaas\Lrs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $profile_id
 * @property int $activity_id
 * @property string $etag
 * @property array|null $parsed_json
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read XapiActivity $activity
 */
class XapiActivityProfile extends Model
{
    protected $table = 'xapi_activity_profiles';

    protected $fillable = [
        'profile_id',
        'activity_id',
        'etag',
        'parsed_json',
    ];

    protected $casts = [
        'parsed_json' => 'array',
    ];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(XapiActivity::class, 'activity_id');
    }
}
