<?php

namespace FossHaas\Courses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DownloadActivity extends Model
{
    use HasFactory;

    protected $touches = ['activity'];

    protected $fillable = [
        'image',
        'filename',
    ];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function renderCard()
    {
        return view('courses::components.activity-cards.download', [
            'course' => $this->activity->course,
            'activity' => $this->activity,
            'state' => $this->activity->course->states->first()?->activities[$this->activity->id],
            'content' => $this,
        ]);
    }
}
