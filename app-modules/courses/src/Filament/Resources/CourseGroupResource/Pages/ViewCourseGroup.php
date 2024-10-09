<?php

namespace FossHaas\Courses\Filament\Resources\CourseGroupResource\Pages;

use FossHaas\Courses\Filament\Resources\CourseGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCourseGroup extends ViewRecord
{
    protected static string $resource = CourseGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
