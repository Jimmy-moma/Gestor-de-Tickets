<?php

namespace App\Filament\Resources\Tickets\Pages;

use App\Filament\Resources\Tickets\TicketResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    protected function afterCreate(): void{
        $ticket = $this->record;
        $adjuntos = $this->data['adjuntos'] ?? [];

        foreach($adjuntos as $filepath){
            $ticket->adjuntos()->create([
                'ruta_del_archivo' => $filepath,
                'nombre_del_archivo' => basename($filepath)
            ]);
        }
    }
}
