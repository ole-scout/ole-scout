<?php

namespace FossHaas\Lrs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $profile_id
 * @property int $agent_id
 * @property string $etag
 * @property array|null $parsed_json
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read XapiAgent $agent
 */
class XapiAgentProfile extends Model
{
    protected $table = 'xapi_agent_profiles';

    protected $fillable = [
        'profile_id',
        'agent_id',
        'etag',
        'parsed_json',
    ];

    protected $casts = [
        'parsed_json' => 'array',
    ];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(XapiAgent::class, 'agent_id');
    }
}
