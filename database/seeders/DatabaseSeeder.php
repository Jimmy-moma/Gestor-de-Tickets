<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\RespuestaTicket;
use Spatie\Permission\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
   use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
$agenteRole = Role::firstOrCreate(['name' => 'agente']);
        $clienteRole = Role::firstOrCreate(['name' => 'cliente']);

        // 2. Crear Usuarios (5 Clientes y 2 Agentes)
        $agentes = User::factory(2)->create()->each(fn ($user) => $user->assignRole($agenteRole));
        $clientes = User::factory(5)->create()->each(fn ($user) => $user->assignRole($clienteRole));

        // 3. Crear Categorías Reales
        $categorias = collect(['Soporte Técnico', 'Facturación', 'Ventas', 'Reporte de Fallos'])->map(function ($nombre) {
            return Categoria::firstOrCreate([
                'nombre' => $nombre,
            ], [
                'is_active' => true,
            ]);
        });

        // 4. Crear 30 Tickets distribuidos entre los clientes
        foreach ($clientes as $cliente) {
            Ticket::factory(rand(4, 8))->create([
                'user_id' => $cliente->id,
                'categoria_id' => $categorias->random()->id,
                'asignado_a' => $agentes->random()->id,
                'descripcion' => Str::random(50)
            ])->each(function ($ticket) use ($cliente) {
                
                // 5. Crear de 1 a 4 respuestas por cada ticket
                RespuestaTicket::factory(rand(1, 4))->create([
                    'ticket_id' => $ticket->id,
                    // Intercala el autor de la respuesta entre el cliente y el agente asignado
                    'user_id' => fake()->randomElement([$cliente->id, $ticket->asignado_a]),
                ]);
            });
        }
    
    }
}
