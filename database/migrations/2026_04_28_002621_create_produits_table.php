<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();

            // Infos de base
            $table->string('nom', 150);
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            // Prix en DA
            $table->integer('prix');

            // Stock
            $table->integer('stock')->default(0);
            $table->integer('seuil_alerte')->default(5); // Alerte admin si stock <= 5

            // Activé / désactivé
            $table->boolean('actif')->default(true);

            $table->timestamps();

            // Index pour les recherches
            $table->index('actif');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
