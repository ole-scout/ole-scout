<?php

namespace FossHaas\Courses\Filament\Resources\CourseResource\Pages;

use FossHaas\Courses\Filament\Resources\CourseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;
}
