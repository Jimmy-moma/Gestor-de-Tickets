<?php

namespace App\Filament\Resources\RespuestaRapidas\Pages;

use App\Filament\Resources\RespuestaRapidas\RespuestaRapidaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRespuestaRapida extends ViewRecord
{
    protected static string $resource = RespuestaRapidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
