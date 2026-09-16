<?php

namespace App\Filament\Resources\Categorias\Schemas;

use App\Models\Categoria;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Set;

class CategoriaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre de la categoría')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur:true)

                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->unique(Categoria::class, 'slug', ignoreRecord:true),
                Textarea::make('descripcion')
                    ->label('Descripcion')
                    ->rows(3)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('¿Categoria Activa?')
                    ->default(true)
                    ->required(),
            ])->columns(2);
    }
}
