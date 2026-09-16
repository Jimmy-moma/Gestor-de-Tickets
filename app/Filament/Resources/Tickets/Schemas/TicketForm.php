<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;
use Illuminate\Support\Str;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                ->schema([
                    Section::make('Información Principal')
                    ->schema([
                        TextInput::make('numero_de_ticket')
                        ->label('Numero de Ticket')
                        ->default('TK-'. strtoupper(Str::random(6)))
                        ->readOnly()     
                        ->required(),
                        TextInput::make('sujeto')
                            ->label('Asunto / Sujeto')
                            ->maxLength(255)
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('descripcion')
                            ->label('Descripcion detallada')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                    Section::make('Relaciones')
                    ->schema([
                        Select::make('user_id')
                            ->label('Cliente')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('asignado_a')
                            ->label('Agente Asignado')
                            ->relationship('agenteAsignado', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('categoria_id')
                            ->label('Categoria / Departamento')
                            ->relationship('categoria', 'nombre')
                            ->searchable()
                            ->preload()
                            ->required(),

                    ])->columns(3)

                ])->columnSpan(2),

                Group::make()
                ->schema([
                    Section::make('Estado y Prioridad')
                    ->schema([
                        Select::make('estatus')
                            ->options([
                                'abierto' => 'Abierto',
                                'en_progreso' => 'En progreso',
                                'cliente_pendiente' => 'Esperando Cliente',
                                'resuelto' => 'Resuelto',
                                'cerrado' => 'Cerrado',
                            ])
                            ->default('abierto')
                            ->required(),
                        Select::make('prioridad')
                                ->options([
                                    'baja' => 'Baja',
                                     'media' => 'Media', 
                                     'alta' => 'Alta', 
                                     'critica' => 'Critica'
                                     ])
                                ->default('media')
                                ->required(),
                                ]),


                ]),

                Section::make('Fechas de Control')
                    ->schema([
                        DateTimePicker::make('resuelto_en')
                            ->label('Resuelto el')
                            ->nullable(),
                        DateTimePicker::make('cerrado_en')
                            ->label('Cerrado el')
                            ->nullable(),

                    ])
               
                
                
                
            ]);
    }
}
