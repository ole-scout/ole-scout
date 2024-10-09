<?php

namespace FossHaas\Courses\Filament\Resources\CourseGroupResource\Pages;

use FossHaas\Courses\Filament\Resources\CourseGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCourseGroup extends CreateRecord
{
    protected static string $resource = CourseGroupResource::class;
}
