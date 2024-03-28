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
        Schema::create('rifas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categoria_id')
                ->index()
                ->constrained('categoria_rifas')
                ->cascadeOnDelete();

            $table->string('titulo');

            $table->string('status')->default('aberto');

            $table->string('imagem')->nullable();

            $table->float('valor', 10, 2);

            $table->text('descricao')->nullable();

            $table->date('data_inicio');
            $table->date('data_previsao_sorteio');

            $table->unsignedInteger('limite_numeros');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rifas');
    }
};
