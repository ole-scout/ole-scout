<?php

namespace FossHaas\Lrs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property array $parsed_json
 * @property string|null $registration
 * @property string|null $verb_id
 * @property \Illuminate\Support\Carbon $timestamp
 * @property int|null $voided_by
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read XapiStatement|null $voidedBy
 * @property-read \Illuminate\Database\Eloquent\Collection<int,XapiActivity> $relatedActivities
 * @property-read \Illuminate\Database\Eloquent\Collection<int,XapiAgent> $relatedAgents
 * @property-read \Illuminate\Database\Eloquent\Collection<int,XapiGroup> $relatedGroups
 * @property-read \Illuminate\Database\Eloquent\Collection<int,XapiStatement> $relatedStatements
 */
class XapiStatement extends Model
{
    protected $table = 'xapi_statements';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'parsed_json',
        'registration',
        'verb_id',
        'timestamp',
        'voided_by',
    ];

    protected $casts = [
        'parsed_json' => 'array',
        'timestamp' => 'datetime',
    ];

    public function voidedBy(): BelongsTo
    {
        return $this->belongsTo(XapiStatement::class, 'voided_by');
    }

    public function relatedActivities(): BelongsToMany
    {
        return $this->belongsToMany(XapiActivity::class, 'xapi_related_activities', 'statement_id', 'activity_id')->withPivot('relationship');
    }

    public function relatedAgents(): BelongsToMany
    {
        return $this->belongsToMany(XapiAgent::class, 'xapi_related_agents', 'statement_id', 'agent_id')->withPivot('relationship');
    }

    public function relatedGroups(): BelongsToMany
    {
        return $this->belongsToMany(XapiGroup::class, 'xapi_related_groups', 'statement_id', 'group_id')->withPivot('relationship');
    }

    public function relatedStatements(): BelongsToMany
    {
        return $this->belongsToMany(XapiStatement::class, 'xapi_related_statements', 'statement_id', 'ref_id')->withPivot('relationship');
    }

    public function relatingStatements(): BelongsToMany
    {
        return $this->belongsToMany(XapiStatement::class, 'xapi_related_statements', 'ref_id', 'statement_id')->withPivot('relationship');
    }
}
