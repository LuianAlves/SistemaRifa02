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
        Schema::create('transacao_rifas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->index()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('rifa_id')
                ->index()
                ->constrained('rifas')
                ->cascadeOnDelete();

            $table->string('titulo');

            $table->string('status_transacao')->default('pendente');

            $table->float('valor', 10, 2);

            $table->text('descricao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacao_rifas');
    }
};
