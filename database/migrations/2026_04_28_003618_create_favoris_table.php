<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favoris', function (Blueprint $table) {
            $table->id();

            // Le client qui ajoute le produit en favori
            $table->foreignId('client_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Le produit favori
            $table->foreignId('produit_id')
                  ->constrained('produits')
                  ->onDelete('cascade');

            $table->timestamps();

            // Un client ne peut pas mettre le même produit 2 fois en favori
            $table->unique(['client_id', 'produit_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favoris');
    }
};
