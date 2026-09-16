<?php

namespace App\Filament\Cliente\Resources\Tickets\Schemas;

use App\Models\Categoria;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('sujeto')
                    ->label('Asunto / Titulo del problema')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Select::make('categoria_id')
                    ->label('Categoria')
                    ->options(Categoria::where('is_active', true)->pluck('nombre', 'id'))
                    ->required()
                    ->searchable(),
                Select::make('prioridad')
                    ->label('Prioridad Percibida')
                    ->options(['baja' => 'Baja', 'media' => 'Media', 'alta' => 'Alta', 'critica' => 'Critica'])
                    ->default('media')
                    ->required(),

                RichEditor::make('descripcion')
                    ->label('Descripcion detallada del problema')
                    ->required()
                    ->columnSpanFull(),
                Hidden::make('estatus')
                    ->default('abierto'),

                Hidden::make('user_id')
                    ->default(Auth::id()),
            ]);
    }
}
