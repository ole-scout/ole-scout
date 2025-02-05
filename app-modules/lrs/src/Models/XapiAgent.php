<?php

namespace FossHaas\Lrs\Models;

use FossHaas\Lrs\Enums\InverseFunctionalIdentifier as IFI;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string|null $name
 * @property \FossHaas\Lrs\Enums\InverseFunctionalIdentifier $ifi_type
 * @property string $ifi_value
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int,XapiGroup> $groups
 * @property-read \Illuminate\Database\Eloquent\Collection<int,XapiStatement> $relatedStatements
 */
class XapiAgent extends Model
{
    protected $table = 'xapi_agents';

    protected $fillable = [
        'name',
        'ifi_type',
        'ifi_value',
    ];

    protected $casts = [
        'ifi_type' => IFI::class,
    ];

    public function scopeWhereIfi(Builder $query, array $ifi): void
    {
        foreach (IFI::fromData($ifi) as [$ifiType, $ifiValue]) {
            $query->orWhere(function (Builder $query) use ($ifiType, $ifiValue) {
                $query->where([
                    'ifi_type' => $ifiType,
                    'ifi_value' => $ifiValue,
                ]);
            });
        }
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(XapiGroup::class, 'xapi_group_members', 'agent_id', 'group_id');
    }

    public function relatedStatements(): BelongsToMany
    {
        return $this->belongsToMany(XapiStatement::class, 'xapi_related_agents', 'agent_id', 'statement_id')->withPivot('relationship');
    }
}
