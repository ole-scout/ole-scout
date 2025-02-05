<?php

namespace FossHaas\Lrs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property array|null $definition
 * @property \Illuminate\Support\Carbon|null $synced_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, XapiStatement> $relatedStatements
 */
class XapiActivity extends Model
{
    protected $table = 'xapi_activities';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'definition',
    ];

    protected $casts = [
        'definition' => 'array',
    ];

    public function relatedStatements(): BelongsToMany
    {
        return $this->belongsToMany(XapiStatement::class, 'xapi_related_activities', 'activity_id', 'statement_id')->withPivot('relationship');
    }
}
