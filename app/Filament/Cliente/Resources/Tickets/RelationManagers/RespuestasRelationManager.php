<?php

namespace App\Filament\Cliente\Resources\Tickets\RelationManagers;

use App\Filament\Cliente\Resources\Tickets\TicketResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class RespuestasRelationManager extends RelationManager
{
    protected static string $relationship = 'respuestas';

    //protected static ?string $relatedResource = TicketResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('es_nota_interna', false))
            ->columns([
                TextColumn::make('user.name')
                    ->label('Publicado por')
                    ->weight('bold'),

                TextColumn::make('contenido')
                    ->label('Mensaje')
                    ->html(),

                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i'),
                ])
            ->headerActions([
                CreateAction::make()
                    ->label('Responder al Agente')
                    ->modalHeading('Enviar Respuesta')
                    ->schema([
                    RichEditor::make('contenido')
                        ->label('Mensaje')
                        ->required()
                        ->columnSpanFull(),
                    ])
                    ->mutateDataUsing(function (array $data): array {
                        $data['user_id'] = Auth::id();
                        $data['es_nota_interna'] = false;
                        return $data;
                    }),
            ]);
    }       
}
