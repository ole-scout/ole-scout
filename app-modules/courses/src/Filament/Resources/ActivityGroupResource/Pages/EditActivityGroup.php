<?php

namespace FossHaas\Courses\Filament\Resources\ActivityGroupResource\Pages;

use FossHaas\Courses\Filament\Resources\ActivityGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActivityGroup extends EditRecord
{
    protected static string $resource = ActivityGroupResource::class;

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
