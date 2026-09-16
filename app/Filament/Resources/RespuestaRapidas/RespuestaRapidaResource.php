<?php

namespace App\Filament\Resources\RespuestaRapidas;

use App\Filament\Resources\RespuestaRapidas\Pages\CreateRespuestaRapida;
use App\Filament\Resources\RespuestaRapidas\Pages\EditRespuestaRapida;
use App\Filament\Resources\RespuestaRapidas\Pages\ListRespuestaRapidas;
use App\Filament\Resources\RespuestaRapidas\Pages\ViewRespuestaRapida;
use App\Filament\Resources\RespuestaRapidas\Schemas\RespuestaRapidaForm;
use App\Filament\Resources\RespuestaRapidas\Schemas\RespuestaRapidaInfolist;
use App\Filament\Resources\RespuestaRapidas\Tables\RespuestaRapidasTable;
use App\Models\RespuestaRapida;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RespuestaRapidaResource extends Resource
{
    protected static ?string $model = RespuestaRapida::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleBottomCenter;

    protected static ?string $recordTitleAttribute = 'Respuestas Rapidas';

    protected static string | UnitEnum | null $navigationGroup = 'Configuración de Soporte';
    protected static ?string $modelLabel = 'Respuesta Rápida';
    protected static ?string $pluralModelLabel = 'Respuestas Rápidas';

    public static function form(Schema $schema): Schema
    {
        return RespuestaRapidaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RespuestaRapidaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RespuestaRapidasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRespuestaRapidas::route('/'),
            'create' => CreateRespuestaRapida::route('/create'),
            'view' => ViewRespuestaRapida::route('/{record}'),
            'edit' => EditRespuestaRapida::route('/{record}/edit'),
        ];
    }
}
