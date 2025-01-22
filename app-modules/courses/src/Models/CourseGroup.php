<?php

namespace FossHaas\Courses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CourseGroup extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\CourseGroupFactory> */
    use HasFactory;

    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')
            ->acceptsMimeTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'])
            ->singleFile();
    }
}
