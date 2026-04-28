<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->id();

            // Le client qui a laissé l'avis
            $table->foreignId('client_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Type d'avis
            $table->enum('type', ['estheticienne', 'institut']);

            // Si avis sur une esthe → la pointer (sinon null pour avis institut)
            $table->foreignId('estheticienne_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('cascade');

            // Si avis sur esthe → lié à un RDV terminé spécifique (sinon null)
            $table->foreignId('rendez_vous_id')
                  ->nullable()
                  ->constrained('rendez_vous')
                  ->onDelete('cascade');

            // Contenu de l'avis
            $table->tinyInteger('note'); // 1 à 5 étoiles
            $table->text('commentaire');

            // Statut de modération
            $table->enum('statut', [
                'en_attente',
                'publie',
                'refuse'
            ])->default('en_attente');

            // Si refusé, raison de l'admin (optionnel)
            $table->text('motif_refus')->nullable();

            $table->timestamps();

            // Index pour les recherches fréquentes
            $table->index(['type', 'statut']);
            $table->index('estheticienne_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
