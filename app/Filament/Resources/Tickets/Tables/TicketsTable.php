<?php

namespace App\Filament\Resources\Tickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('numero_de_ticket')
                    ->label('Codigo')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('sujeto')
                    ->label('Asunto')
                    ->limit(30)
                    ->searchable(),

                TextColumn::make('descripcion')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('cliente')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('categoria.nombre')
                    ->label('Categoria')
                    ->badge()
                    ->searchable(),
                TextColumn::make('agenteAsignado.name')
                    ->label('Agente')
                    ->placeholder('Sin Asignar')
                    ->sortable(),
                TextColumn::make('estatus')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state){
                        'abierto' => 'danger',
                        'en_progreso' => 'warning',
                        'cliente_pendiente' => 'info',
                        'resuelto' => 'success',
                        'cerrado' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'abierto' => 'Abierto',
                        'en_progreso' => 'En Progreso',
                        'cliente_pendiente' => 'Esperando Cliente',
                        'resuelto' => 'Resuelto',
                        'cerrado' => 'Cerrado',
                        default => $state,
                    }),




                TextColumn::make('prioridad')
                    ->label('Prioridad')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baja' => 'gray',
                        'media' => 'info',
                        'alta' => 'warning',
                        'critica' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'baja' => 'Baja',
                        'media' => 'Media',
                        'alta' => 'Alta',
                        'critica' => 'Crítica',
                        default => $state,
                    }),

                TextColumn::make('resuelto_en')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('cerrado_en')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('estatus')
                    ->label('Filtrar por Estado')
                    ->options([
                        'abierto' => 'Abierto',
                        'en_progreso' => 'En Progreso',
                        'cliente_pendiente' => 'Esperando Cliente',
                        'resuelto' => 'Resuelto',
                        'cerrado' => 'Cerrado',
                    ]),

                SelectFilter::make('prioridad')
                    ->label('Filtrar por Prioridad')
                    ->options([
                        'baja' => 'Baja',
                        'media' => 'Media',
                        'alta' => 'Alta',
                        'critica' => 'Crítica',
                    ]),

                SelectFilter::make('categoria_id')
                    ->label('Filtrar por Categoría')
                    ->relationship('categoria', 'nombre'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
