<?php

namespace App\Filament\Cliente\Resources\Tickets\RelationManagers;

use App\Filament\Cliente\Resources\Tickets\TicketResource;
use App\Models\Ticket;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
                    FileUpload::make('attachments')
                        ->label('Adjuntar Archivos')
                        ->multiple()
                        ->disk('publics')
                        ->directory('reply-attachments')
                        ->maxSize(5120)
                        ->dehydrated(false)
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'application/pdf'])
                        ->columnSpanFull(),
                        ])
                    ->mutateDataUsing(function (array $data): array {
                        $data['user_id'] = Auth::id();
                        $data['es_nota_interna'] = false;
                        return $data;
                    })
                    
                    ->after(function (Model $record, array $data): void {

                        if (!empty($data['attachments'])) {
                            foreach ($data['attachments'] as $filePath) {
                                $record->adjuntos()->create([
                                    'ticket_id' => $record->ticket_id,
                                    'ruta_del_archivo' => $filePath,
                                    'nombre_del_archivo' => basename($filePath),
                                ]);
                            }
                         }
                          } )             


            ]);
    }       
}
