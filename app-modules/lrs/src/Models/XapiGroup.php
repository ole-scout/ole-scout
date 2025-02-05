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
 * @property-read \Illuminate\Database\Eloquent\Collection<int,XapiAgent> $members
 * @property-read \Illuminate\Database\Eloquent\Collection<int,XapiStatement> $relatedStatements
 */
class XapiGroup extends Model
{
    protected $table = 'xapi_groups';

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

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(XapiAgent::class, 'xapi_group_members', 'group_id', 'agent_id');
    }

    public function relatedStatements(): BelongsToMany
    {
        return $this->belongsToMany(XapiStatement::class, 'xapi_related_groups', 'group_id', 'statement_id')->withPivot('relationship');
    }
}
