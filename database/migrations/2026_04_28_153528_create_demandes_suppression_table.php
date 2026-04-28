<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demandes_suppression', function (Blueprint $table) {
            $table->id();

            // L'utilisateur demandeur (client ou esthéticienne)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Statut de la demande
            $table->enum('statut', [
                'en_attente',
                'acceptee',
                'refusee',
            ])->default('en_attente');

            // Motif de la demande (raison du user, optionnel)
            $table->text('motif_demande')->nullable();

            // Motif de refus (raison de l'admin, si refusée)
            $table->text('motif_refus')->nullable();

            // Dates importantes
            $table->dateTime('date_traitement')->nullable(); // Quand admin a traité

            $table->timestamps();

            // Index pour les recherches admin
            $table->index('statut');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes_suppression');
    }
};
