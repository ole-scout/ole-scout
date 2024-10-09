<?php

namespace FossHaas\Courses\Filament\Resources\ActivityGroupResource\Pages;

use FossHaas\Courses\Filament\Resources\ActivityGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivityGroups extends ListRecords
{
    protected static string $resource = ActivityGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
