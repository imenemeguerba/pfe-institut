<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();

            // Numéro de commande lisible (ex: "CMD-2026-00001")
            $table->string('numero', 30)->unique();

            // Le client qui passe la commande
            $table->foreignId('client_id')
                  ->constrained('users')
                  ->onDelete('restrict');

            // Statut de la commande
            $table->enum('statut', [
                'en_attente',    // Vient d'être passée, attend confirmation admin
                'confirmee',     // Admin a confirmé, stock décrémenté
                'annulee'        // Annulée (client ou admin)
            ])->default('en_attente');

            // Prix
            $table->integer('prix_original');  // Avant code promo
            $table->integer('prix_final');     // Après code promo

            // Code promo (optionnel)
            $table->foreignId('code_promo_id')
                  ->nullable()
                  ->constrained('codes_promo')
                  ->onDelete('set null');

            // Dates importantes
            $table->dateTime('date_confirmation')->nullable(); // Quand admin a confirmé
            $table->dateTime('date_annulation')->nullable();   // Si annulée

            // Motif d'annulation (si annulée)
            $table->text('motif_annulation')->nullable();

            $table->timestamps();

            // Indexes pour les recherches
            $table->index('statut');
            $table->index('client_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
