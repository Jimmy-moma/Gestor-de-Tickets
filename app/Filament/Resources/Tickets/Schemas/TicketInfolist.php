<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('numero_de_ticket'),
                TextEntry::make('sujeto'),
                TextEntry::make('descripcion'),
                TextEntry::make('estatus')
                    ->badge(),
                TextEntry::make('prioridad')
                    ->badge(),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('asignado_a')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('categoria.id')
                    ->label('Categoria'),
                TextEntry::make('resuelto_en')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('cerrado_en')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
