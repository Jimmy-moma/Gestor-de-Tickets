<?php

namespace App\Filament\Cliente\Resources\Tickets\Pages;

use App\Filament\Cliente\Resources\Tickets\TicketResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Override;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    #[Override]
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['numero_de_ticket'] = 'TK-' . strtoupper(Str::random(6));
        return parent::mutateFormDataBeforeCreate($data);
    }
}
