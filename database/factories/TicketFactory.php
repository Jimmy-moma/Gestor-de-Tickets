<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_de_ticket' => 'TK-' . strtoupper(Str::random(6)),
            'sujeto' => $this->faker->sentence(6),
            'descripcion' => '<p>' . $this->faker->paragraph(3) . '</p>',
            'estatus' => $this->faker->randomElement(['abierto', 'en_progreso', 'cliente_pendiente', 'resuelto', 'cerrado']),
            'prioridad' => $this->faker->randomElement(['baja', 'media', 'alta', 'critica']),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),

        ];
    }
}
