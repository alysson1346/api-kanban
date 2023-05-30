<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('titulo');
            $table->string('conteudo');
            $table->string('lista')->default('To Do');
            $table->timestamps();

            // Adicionar a coluna de chave estrangeira para o usuário
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');            
        });

    }


    public function down(): void
    {
        Schema::dropIfExists('cards');
    }



};
