<?php

namespace App\Filament\Cliente\Resources\Tickets;

use App\Filament\Cliente\Resources\Tickets\Pages\CreateTicket;
use App\Filament\Cliente\Resources\Tickets\Pages\EditTicket;
use App\Filament\Cliente\Resources\Tickets\Pages\ListTickets;
use App\Filament\Cliente\Resources\Tickets\RelationManagers\RespuestasRelationManager;
use App\Filament\Cliente\Resources\Tickets\Schemas\TicketForm;
use App\Filament\Cliente\Resources\Tickets\Tables\TicketsTable;
use App\Models\Ticket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Override;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Ticket';

    public static function form(Schema $schema): Schema
    {
        return TicketForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RespuestasRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTickets::route('/'),
            'create' => CreateTicket::route('/create'),
            'edit' => EditTicket::route('/{record}/edit'),
        ];
    }

    #[Override]
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }
}
