<?php

namespace FossHaas\Courses\Filament\Resources\ActivityGroupResource\Pages;

use FossHaas\Courses\Filament\Resources\ActivityGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewActivityGroup extends ViewRecord
{
    protected static string $resource = ActivityGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
