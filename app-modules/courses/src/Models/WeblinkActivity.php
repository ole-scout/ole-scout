<?php

namespace FossHaas\Courses\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeblinkActivity extends Model
{
    use HasFactory, HasTimestamps;

    public static $viewName = 'courses::activity-cards.weblink';

    protected $touches = ['activity'];

    protected $fillable = [
        'image',
        'url',
    ];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
