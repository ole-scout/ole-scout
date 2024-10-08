<?php

namespace FossHaas\Courses\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DownloadActivity extends Model
{
    use HasFactory, HasTimestamps;

    public static $viewName = 'courses::activity-cards.download';

    protected $touches = ['activity'];

    protected $fillable = [
        'image',
        'filename',
    ];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
