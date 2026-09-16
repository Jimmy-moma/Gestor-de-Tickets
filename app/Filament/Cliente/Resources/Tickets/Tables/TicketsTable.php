<?php

namespace App\Filament\Cliente\Resources\Tickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('numero_de_ticket')
                    ->label('Codigo')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('sujeto')
                    ->label('Asunto')
                    ->limit(40)
                    ->searchable(),
                TextColumn::make('categoria.nombre')
                    ->label('Categoria'),
                TextColumn::make('estatus')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string =>match ($state){
                        'abierto' => 'danger',
                        'en_progreso' => 'warning',
                        'cliente_pendiente' => 'info',
                        'resuelto' => 'success',
                        'cerrado' => 'gray',
                        default => 'gray',
                    }),
     
                TextColumn::make('created_at')
                    ->label('Fecha de Creacion')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([

                ViewAction::make()->label('Ver Hilo')
            ]);

    }
}
