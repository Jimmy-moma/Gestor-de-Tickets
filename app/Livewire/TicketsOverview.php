<?php

namespace App\Livewire;

use App\Models\Ticket;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TicketsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Total de Tickets', Ticket::count())
                ->description('Resgistrados en el sitema')
                ->descriptionIcon(Heroicon::Ticket)
                ->color('primary'),
            Stat::make('Tickets Abiertos', Ticket::where('estatus', 'abierto')->count())
                ->description('Requieren atencion urgente')
                ->descriptionIcon(Heroicon:: ExclamationCircle)
                ->color('danger'),
            Stat::make('En Progreso', Ticket::where('estatus', 'en_progreso')->count())
                ->description('Agentes trabajando en el caso')
                ->descriptionIcon(Heroicon::Clock)
                ->color('warning'),
            Stat::make('Tickets Resueltos', Ticket::where('estatus', 'resuelto')->count())
                ->description('Atendidos con éxito')
                ->descriptionIcon(Heroicon::CheckCircle)
                ->color('success'),
        ];
    }
}
