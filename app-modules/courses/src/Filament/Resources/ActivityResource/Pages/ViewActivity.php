<?php

namespace FossHaas\Courses\Filament\Resources\ActivityResource\Pages;

use FossHaas\Courses\Filament\Resources\ActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewActivity extends ViewRecord
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
