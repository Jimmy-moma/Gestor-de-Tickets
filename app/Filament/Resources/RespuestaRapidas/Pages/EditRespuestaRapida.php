<?php

namespace App\Filament\Resources\RespuestaRapidas\Pages;

use App\Filament\Resources\RespuestaRapidas\RespuestaRapidaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRespuestaRapida extends EditRecord
{
    protected static string $resource = RespuestaRapidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
