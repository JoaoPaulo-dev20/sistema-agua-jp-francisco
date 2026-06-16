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
    Schema::create('leituras', function (Blueprint $table) {
        $table->id();
        $table->foreignId('consumidor_id')->constrained('consumidores')->onDelete('cascade');
        $table->unsignedTinyInteger('mes_referencia');
        $table->unsignedSmallInteger('ano_referencia');
        $table->decimal('leitura_anterior', 10, 2);
        $table->decimal('leitura_atual', 10, 2);
        $table->decimal('consumo_m3', 10, 2);
        $table->timestamps();

        $table->unique(['consumidor_id', 'mes_referencia', 'ano_referencia']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leituras');
    }
};
