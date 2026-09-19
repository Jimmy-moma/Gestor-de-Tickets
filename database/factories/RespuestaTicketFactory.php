<?php

namespace Database\Factories;

use App\Models\RespuestaTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RespuestaTicket>
 */
class RespuestaTicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contenido' => '<p>' . $this->faker->paragraph(2) . '</p>',
            'es_nota_interna' => $this->faker->boolean(20), // 20% de probabilidad de ser nota interna
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
