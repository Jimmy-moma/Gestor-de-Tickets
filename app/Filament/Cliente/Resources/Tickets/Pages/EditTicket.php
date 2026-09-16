<?php

namespace App\Filament\Cliente\Resources\Tickets\Pages;

use App\Filament\Cliente\Resources\Tickets\TicketResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTicket extends EditRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
