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
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitante_id')->constrained('usuarios');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->string('titulo', 120);
            $table->text('descricao');
            $table->string('prioridade', 20)->default('Média');
            $table->string('status', 30)->default('Pendente de Atendimento');
            $table->timestampTz('criado_em')->useCurrent();
            $table->timestampTz('atualizado_em')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};
