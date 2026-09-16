<?php

namespace App\Filament\Resources\Tickets\Tables;

use App\Models\Ticket;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
use Filament\Notifications\Notification;

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
                Action::make('marcarResuelto')
                ->label('Resolver')
                ->icon(Heroicon::CheckCircle)
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('¿Marcar ticket como resuelto?')
                ->modalDescription('Esta acción actualizará el estado a Resuelto y registrara la fecha actual.')
                ->visible( fn (Ticket $record): bool => !in_array($record->estatus, ['resuelto', 'cerrado']))
                ->action(function (Ticket $record) {
                    $record->update([
                        'estatus' => 'resuelto',
                        'resuelto_en' => now()
                    ]);

                    Notification::make()
                        ->title('Ticket Resuelto')
                        ->success()
                        ->send();
                }),

                Action::make('reasignar')
                ->label('Asignar')
                ->icon(Heroicon::UserPlus)
                ->color('info')
                ->schema([
                    Select::make('asignado_a')
                    ->label('Seleccionar Agente')
                    ->relationship('agenteAsignado', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                ])
                ->action(function(Ticket $record, array $data){
                    $record->update([
                        'asignado_a' =>$data['asignado_a'],
                        'estatus' => $record->estatus === 'abierto' ? 'en_progreso' : $record->estatus,
                    ]);

                    Notification::make()
                    ->title('Agente Asignado')
                    ->info()
                    ->send();
                }),

                Action::make('cambiarPrioridad')
                ->label('Nueva Prioridad')
                ->icon(Heroicon::ExclamationTriangle)
                ->color('warning')
                ->schema([
                    Select::make('prioridad')
                    ->label('Nueva Prioridad')
                    ->options([
                        'baja' => 'Baja',
                        'media' => 'Media',
                        'alta' => 'Alta',
                        'critica' => 'Critica',
                    ])
                    ->required(),
                ])
                ->action(function (Ticket $record, array $data) {
                    $record->update([
                        'prioridad' => $data['prioridad']
                    ]);
                    Notification::make()
                        ->title('Prioridad Actualizada')
                        ->warning()
                        ->send();
                })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
