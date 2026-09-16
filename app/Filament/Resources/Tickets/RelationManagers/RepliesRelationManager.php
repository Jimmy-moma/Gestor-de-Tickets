<?php

namespace App\Filament\Resources\Tickets\RelationManagers;

use App\Filament\Resources\Tickets\TicketResource;
use App\Models\RespuestaRapida;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Override;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class RepliesRelationManager extends RelationManager
{
    protected static string $relationship = 'respuestas';
    protected static ?string $title = 'Hilo de Conversacion y Notas';

    //protected static ?string $relatedResource = TicketResource::class;


    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('canned_response')
                ->label('Carga Respuesta Rapida')
                ->options(RespuestaRapida::where('esta_activo', true)->pluck('titulo', 'contenido'))
                ->searchable()
                ->reactive()
                ->afterStateUpdated(function ($state, Set $set) {
                    if($state){
                        $set('contenido', $state);
                    }
                })
                ->dehydrated(false)
                ->columnSpanFull(),
            RichEditor::make('contenido')
                ->label('Mensaje / Respuesta')
                ->required()
                ->columnSpanFull(),
            Toggle::make('es_nota_interna')
                ->label('¿Es una Nota Interna?')
                ->helperText('Las notas interrnas solo son visibles para agentes y administradores')
                ->default(false),
            Hidden::make('user_id')
            ->default(Auth::id())

            ]);
    }


    public function table(Table $table): Table
    {

        return $table
            ->recordTitleAttribute('contenido')
            ->columns([
                TextColumn::make('user.name')
                    ->label('Autor')
                    ->weight('bold'),
                TextColumn::make('contenido')
                    ->label('Mensaje')
                    ->html()
                    ->limit(1000),
                IconColumn::make('is_internal_note')
                    ->label('Nota Interna')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedLockClosed)
                    ->falseIcon(Heroicon::OutlinedChatBubbleLeft)
                    ->trueColor('warning')
                    ->falseColor('gray'),
                TextColumn::make('created_at')
                ->label('Fecha')
                ->dateTime('d/m/Y H:i')
                ->sortable()
            ])
            ->defaultSort('created_at')
            ->headerActions([
                CreateAction::make()
                ->label('Responder / Agregar Nota')
                ->modalHeading('Responder al Ticket')
                ->mutateDataUsing(function (array $data): array {
                    $data['user_id'] = Auth::id();
                    return $data;
                })
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make()
            ]);
    }
}
