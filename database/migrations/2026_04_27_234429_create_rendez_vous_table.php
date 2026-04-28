<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->id();

            // Acteurs du RDV
            $table->foreignId('client_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('estheticienne_id')
                  ->constrained('users')
                  ->onDelete('restrict');

            // Dates et durée
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->integer('duree_totale'); // En minutes (calculé auto)

            // Prix
            $table->integer('prix_original'); // Avant code promo
            $table->integer('prix_final');    // Après code promo

            // Code promo (optionnel)
            // FK ajoutée plus tard quand on créera la table codes_promo
            $table->unsignedBigInteger('code_promo_id')->nullable();

            // Statut du RDV
            $table->enum('statut', [
                'en_attente',
                'confirme',
                'refuse',
                'annule',
                'termine'
            ])->default('en_attente');

            // Champs optionnels
            $table->text('notes')->nullable();          // Notes du client (allergies, demandes spéciales)
            $table->text('motif_refus')->nullable();    // Si refusé/annulé

            $table->timestamps();

            // Index pour les recherches fréquentes
            $table->index('date_debut');
            $table->index('statut');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rendez_vous');
    }
};
