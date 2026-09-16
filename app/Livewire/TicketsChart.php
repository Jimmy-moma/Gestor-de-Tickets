<?php

namespace App\Livewire;

use App\Models\Ticket;
use Filament\Widgets\ChartWidget;

class TicketsChart extends ChartWidget
{
    protected  ?string $heading = 'Distribucion de tickets por estado';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Cantidad de Tickets',
                    'data' => [
                        Ticket::where('estatus', 'abierto')->count(),
                        Ticket::where('estatus', 'en_progreso')->count(),
                        Ticket::where('estatus', 'cliente_pendiente')->count(),
                        Ticket::where('estatus', 'resuelto')->count(),
                        Ticket::where('estatus', 'cerrado')->count(),
                    ],
                    'backgroundColor' => [
                        '#ef4444', // Abierto - Rojo
                        '#f59e0b', // En Progreso - Amarillo
                        '#3b82f6', // Esperando Cliente - Azul
                        '#10b981', // Resuelto - Verde
                        '#6b7280', // Cerrado - Gris
                    ],
                ],
            ],
            'labels' => ['Abiertos', 'En Progreso', 'Esperando Cliente', 'Resueltos', 'Cerrados'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
