<?php

namespace App\Filament\Resources\SettingPlayerStreamResource\Pages;

use App\Filament\Resources\SettingPlayerStreamResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSettingPlayerStream extends CreateRecord
{
    protected static string $resource = SettingPlayerStreamResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
