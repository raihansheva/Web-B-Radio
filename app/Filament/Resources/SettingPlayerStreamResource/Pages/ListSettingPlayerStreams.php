<?php

namespace App\Filament\Resources\SettingPlayerStreamResource\Pages;

use App\Filament\Resources\SettingPlayerStreamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSettingPlayerStreams extends ListRecords
{
    protected static string $resource = SettingPlayerStreamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
