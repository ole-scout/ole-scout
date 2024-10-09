<?php

namespace FossHaas\Courses\Filament\Resources\CourseGroupResource\Pages;

use FossHaas\Courses\Filament\Resources\CourseGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourseGroup extends EditRecord
{
    protected static string $resource = CourseGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
