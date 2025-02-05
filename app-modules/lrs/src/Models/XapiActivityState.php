<?php

namespace FossHaas\Lrs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $state_id
 * @property int $agent_id
 * @property int $activity_id
 * @property string|null $registration
 * @property string $etag
 * @property array|null $parsed_json
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read XapiAgent $agent
 * @property-read XapiActivity $activity
 */
class XapiActivityState extends Model
{
    protected $table = 'xapi_activity_states';

    protected $fillable = [
        'state_id',
        'agent_id',
        'activity_id',
        'registration',
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

    public function activity(): BelongsTo
    {
        return $this->belongsTo(XapiActivity::class, 'activity_id');
    }
}
