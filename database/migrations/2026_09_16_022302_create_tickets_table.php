<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('numero_de_ticket')->unique();
            $table->string('sujeto');
            $table->string('descripcion');
            $table->enum('estatus', ['abierto', 'en_progreso', 'cliente_pendiente', 'resuelto', 'cerrado'])->default('abierto');
            $table->enum('prioridad', ['baja', 'media', 'alta', 'critica'])->default('media');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('asignado_a')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('categoria_id')->constrained()->cascadeOnDelete();
            $table->timestamp('resuelto_en')->nullable();
            $table->timestamp('cerrado_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
