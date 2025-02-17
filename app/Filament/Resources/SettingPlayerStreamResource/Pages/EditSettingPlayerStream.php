<?php

namespace App\Filament\Resources\SettingPlayerStreamResource\Pages;

use App\Filament\Resources\SettingPlayerStreamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSettingPlayerStream extends EditRecord
{
    protected static string $resource = SettingPlayerStreamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
