<?php

namespace App\Filament\Resources\RespuestaRapidas\Pages;

use App\Filament\Resources\RespuestaRapidas\RespuestaRapidaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRespuestaRapidas extends ListRecords
{
    protected static string $resource = RespuestaRapidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
