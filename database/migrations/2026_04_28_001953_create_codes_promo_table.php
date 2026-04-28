<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('codes_promo', function (Blueprint $table) {
            $table->id();

            // Le code unique tapé par le client (ex: "RAMADAN2026")
            $table->string('code', 50)->unique();

            // Description (visible par l'admin uniquement)
            $table->string('description')->nullable();

            // Type de réduction
            $table->enum('type_reduction', ['pourcentage', 'montant']);

            // Valeur de la réduction
            // Si pourcentage: 10 = 10%
            // Si montant: 500 = 500 DA
            $table->integer('valeur');

            // S'applique à : services, produits, ou les deux
            $table->enum('applicable_a', ['services', 'produits', 'les_deux']);

            // Période de validité
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');

            // Limites d'utilisation
            $table->integer('limite_utilisation')->nullable(); // null = illimité
            $table->integer('nombre_utilisations')->default(0); // compteur

            // Activé / désactivé
            $table->boolean('actif')->default(true);

            $table->timestamps();

            // Index pour les recherches rapides
            $table->index(['actif', 'date_debut', 'date_fin']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('codes_promo');
    }
};
