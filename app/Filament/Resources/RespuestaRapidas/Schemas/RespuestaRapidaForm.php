<?php

namespace App\Filament\Resources\RespuestaRapidas\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RespuestaRapidaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Plantilla de Respuesta')
                ->schema([
                    TextInput::make('titulo')
                    ->label('Titulo / Identificador')
                    ->placeholder('Ej: Solicitar Capturas de pantalla')
                    ->required()
                    ->maxLength(255),
                    Toggle::make('esta_activo')
                        ->label('Activa')
                        ->default(true),
                    RichEditor::make('contenido')
                        ->label('Contenido de la Respuesta')
                        ->placeholder('Escribe el texto predefinido que usarán los agentes ...')
                        ->required()
                        ->columnSpanFull(),
                    
                ])->columnSpanFull()
                
            ]);
    }
}
